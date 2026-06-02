<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request_Number;
use Illuminate\Support\Facades\Crypt;
class MultiStepFormController extends Controller
{
    private const FORM_VIEWS = [
        'REQUEST FOR ASSISTANCE (RFA) FORM'
            => 'forms.aksyon',
        'REQUEST FOR VERIFICATION / CERTIFICATION OF OFW RECORDS'
            => 'forms.processing',
        'SINGLE-ENTRY APPROACH (SENA)'
            => 'forms.sena',
        'ENHANCED LIVEHOOD PROGRAM FOR OFW REINTEGRATION (ELPOR) APPLICATION FORM'
            => 'forms.elpor',
    ];

    public function showStep(Request $request)
    {
        // On first entry (signed URL), store request_id in session
        if ($request->query('request_id')) {
            session(['form_request_id' => $request->query('request_id')]);
        }

        $encryptedId = session('form_request_id');

        if (!$encryptedId) {
            abort(403, 'Session expired. Please use the link from your email.');
        }

        $requestNumber = $this->resolveRecord($encryptedId);

        $formSteps   = collect($requestNumber->form_step);
        $uploadStep  = $formSteps->count() + 1;
        $totalSteps  = $uploadStep;
        $currentStep = (int) $request->query('step', 1);
        $currentStep = max(1, min($currentStep, $totalSteps));

        $shared = [
            'requestNumber' => $requestNumber,
            'steps'         => $formSteps->toArray(),
            'currentStep'   => $currentStep,
            'totalSteps'    => $totalSteps,
            'encryptedId'   => $encryptedId,
            'prevUrl'       => $currentStep > 1
                ? route('forms.step', ['step' => $currentStep - 1])  // ← use forms.step
                : null,
        ];

        if ($currentStep === $uploadStep) {
            return view('forms.requirements', $shared);
        }

        $label    = $formSteps->get($currentStep - 1);
        $viewName = self::FORM_VIEWS[$label] ?? 'forms.requirements';

        return view($viewName, array_merge($shared, ['label' => $label]));
    }
    public function submitAllForms(Request $request)
    {
        $encryptedId = session('form_request_id');

        if (!$encryptedId) {
            abort(403, 'Session expired. Please use the link from your email.');
        }

        $requestNumber = $this->resolveRecord($encryptedId);
        $currentStep   = (int) $request->input('current_step', 1);
        $formSteps     = collect($requestNumber->form_step);
        $uploadStep    = $formSteps->count() + 1;

        if ($currentStep === $uploadStep) {
            $this->handleFileUploads($request, $requestNumber);
            $requestNumber->update(['status' => 'FORMS_COMPLETED']);
            return redirect()->route('forms.success');
        }

        $stepKey = 'forms.step_' . $currentStep;
        session([$stepKey => $request->except(['_token', 'current_step'])]);

        // ← use forms.step, no signature params needed
        return redirect()->route('forms.step', ['step' => $currentStep + 1]);
    }

    private function resolveRecord(string $encryptedId): Request_Number
    {
        $id = Crypt::decryptString($encryptedId);
 
        return Request_Number::with([
            'requestOfw',
            'requestParty',
            'requestOfwAddress',
            'requestPartyAddress',
        ])->findOrFail($id);
    }

    private function handleFileUploads(Request $request, Request_Number $requestNumber): void
    {
        $fileFields = [
            'passport',
            'boarding',
            'contract',
            'visa',
            'medical',
            'endorsement',
            'distress',
            'valid_id',
        ];
 
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                foreach ($request->file($field) as $file) {
                    // Adjust the storage path and model relationship to match your app
                    $path = $file->store("requests/{$requestNumber->id}/{$field}", 'public');
 
                    // Example: save to a related uploads model
                    // $requestNumber->uploads()->create([
                    //     'field'     => $field,
                    //     'file_path' => $path,
                    //     'file_name' => $file->getClientOriginalName(),
                    // ]);
                }
            }
        }
    }
}
