<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request_Number;
use App\Models\Request_Party;
use App\Models\Request_OFW;
use App\Models\Request_Party_Address;
use App\Models\Request_Form;
use App\Models\Request_Form_Field;
use App\Models\Request_Form_Entries;
use App\Models\Request_Form_Field_Values;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\ProcessingRequest;
use Illuminate\Support\Facades\Http;

class SubmittedFormController extends Controller
{
    // public function index()
    // {
    //     $requests = Request_Number::latest()->paginate(10);

    //     return view('forms-submitted.index', compact('requests'));
    // }


    // /**
    //  * Show list of submitted GENERAL forms
    //  */
    // public function general()
    // {
    //     $requests = Request_Number::with([
    //         'requestParty',
    //         'requestOFW'
    //     ])
    //     ->latest()
    //     ->paginate(10);

    //     return view('forms-submitted.general.index', compact('requests'));
    // }


    // /**
    //  * Show specific GENERAL form
    //  */
    // public function showGeneral($id){
    //     // Main request
    //     $request = Request_Number::findOrFail($id);

    //     // Party info
    //     $party = Request_Party::where('request_id', $id)->first();

    //     // Party address
    //     $address = Request_Party_Address::where('request_id', $id)->first();

    //     // OFW info
    //     $ofw = Request_OFW::where('request_id', $id)->first();

    //     // Section C values
    //     $sectionC = DB::table('request_form_entries as rfe')
    //         ->join('request_form_field_values as rffv', 'rffv.request_form_entry_id', '=', 'rfe.id')
    //         ->join('request_form_field as rff', 'rff.id', '=', 'rffv.request_form_field_id')
    //         ->where('rfe.request_id', $id)
    //         ->select(
    //             'rff.field_name',
    //             'rff.field_label',
    //             'rffv.value'
    //         )
    //         ->get()
    //         ->keyBy('field_name'); // IMPORTANT

    //     return view('forms-submitted.general', compact(
    //         'request',
    //         'party',
    //         'address',
    //         'ofw',
    //         'sectionC'
    //     ));
    // }

    public function index()
    {
        $requests = Request_Number::with([
            'requestOfw',
            'requestParty'
        ])
        ->latest() // order by created_at desc
        ->get();

        return view('forms-submitted.index', compact('requests'));
    }

    public function show($id)
    {
        $request = Request_Number::with([
            'requestOfw',
            'requestParty',
            'requestFormEntries.field.form',
            'statusHistory',
        ])->findOrFail($id);

        $forms = $request->requestFormEntries
            ->groupBy(fn($e) => $e->field->request_form_id);

        return view('forms-submitted.show', compact('request', 'forms'));
    }

    /*
    |-------------------------------------------------------
    | OPEN FORM — Show a specific form's entries
    |-------------------------------------------------------
    */
    public function openForm($requestId, $formId)
    {
        $request = Request_Number::with([
            'requestOfw',
            'requestParty',
            'requestPartyAddress',
            'requestFormEntries.field.form',
        ])->findOrFail($requestId);

        $form    = Request_Form::findOrFail($formId);
        $ofw     = $request->requestOfw;
        $party   = $request->requestParty;
        $ofw_address = $request->requestOfwAddress;
        $party_address = $request->requestPartyAddress;


        $entries = $request->requestFormEntries
            ->filter(fn($e) => $e->field->request_form_id == $formId)
            ->values();

        // Keyed by field_name so Blade can do $sectionC['party_lname'] etc.
        $sectionC = $entries->keyBy(fn($e) => $e->field->field_name);

        $entries = $request->requestFormEntries->mapWithKeys(function ($entry) {
            return [$entry->field->field_name => $entry->value];
        });

        return match ($form->form_name) {
            'OFFICIAL DMW-RO3 RFA FORM' =>
                view('forms-submitted.show.general', compact(
                    'request', 'entries', 'form',
                    'ofw', 'party', 'ofw_address', 'party_address' ,'sectionC'
                )),

            'REQUEST FOR ASSISTANCE (RFA) FORM' =>
                view('forms-submitted.show.aksyon', compact(
                    'request', 'entries', 'form',
                    'ofw', 'party', 'ofw_address', 'party_address' ,'sectionC'
                )),

            'REQUEST FOR VERIFICATION / CERTIFICATION OF OFW RECORDS (PROCESSING)' =>
                view('forms-submitted.show.processing', compact(
                    'request', 'entries', 'form',
                    'ofw', 'party', 'ofw_address', 'party_address' ,'sectionC'
                )),

            'SINGLE-ENTRY APPROACH (SENA)' =>
                view('forms-submitted.show.sena', compact(
                    'request', 'entries', 'form',
                    'ofw', 'party', 'ofw_address', 'party_address' ,'sectionC'
                )),

            'REQUEST FOR VERIFICATION / CERTIFICATION OF OFW RECORDS (PROTECTION)' =>
                view('forms-submitted.show.ofwinfo_protection', compact(
                    'request', 'entries', 'form',
                    'ofw', 'party', 'ofw_address', 'party_address' ,'sectionC'
                )),
            default => abort(404, 'Form view not found'),
        };
    }

    public function editGeneral($requestId, $formId)
    {
        $request = Request_Number::with([
            'requestOfw',
            'requestParty',
            'requestPartyAddress',
            'requestOfwAddress',
            'requestFormEntries.field.form',
        ])->findOrFail($requestId);

        $form  = Request_Form::findOrFail($formId);

        $ofw   = $request->requestOfw;
        $party = $request->requestParty;
        $ofw_address   = $request->requestOfwAddress;
        $party_address = $request->requestPartyAddress;

        $entries = $request->requestFormEntries
            ->filter(fn($e) => $e->field->request_form_id == $formId);

        $sectionC = $entries->keyBy(fn($e) => $e->field->field_name);

        $entries = $entries->mapWithKeys(function ($entry) {
            return [$entry->field->field_name => $entry->value];
        });

        return match ($form->form_name) {
            'OFFICIAL DMW-RO3 RFA FORM' =>
                view('forms-submitted.edit.general', compact(
                    'request', 'entries', 'form',
                    'ofw', 'party', 'ofw_address', 'party_address', 'sectionC'
                )),

            default => abort(404, 'Edit view not found'),
        };
    }

    public function saveEditGeneral(Request $request, $requestId, $formId)
    {
        $requestNumber = Request_Number::findOrFail($requestId);

        DB::beginTransaction();

        try {

            // UPDATE PARTY
            $requestNumber->requestParty->update([
                'party_lname' => $request->party_lname,
                'party_fname' => $request->party_fname,
                'party_mname' => $request->party_mname,
                'party_ename' => $request->party_ename,
                'party_bday'  => $request->party_bday,
                'party_gender'=> $request->party_gender,
                'party_relationship'=> $request->party_relationship,
                'party_phone' => $request->party_phone,
                'party_email' => $request->party_email,
            ]);

            $requestNumber->requestPartyAddress->update([
                'province' => $request->party_province_name,
                'municipality' => $request->party_municipality_name,
                'brgy' => $request->party_barangay_name,
                'house_no' => $request->party_house_no,
                'zip_code' => $request->party_zip_code
            ]);

            // UPDATE OFW
            $requestNumber->requestOfw->update([
                'ofw_lname' => $request->ofw_lname,
                'ofw_fname' => $request->ofw_fname,
                'ofw_mname' => $request->ofw_mname,
                'ofw_ename' => $request->ofw_ename,
                'ofw_gender'=> $request->ofw_gender,
                'ofw_phone' => $request->ofw_phone,
                'ofw_email' => $request->ofw_email,
                'ofw_bday'  => $request->ofw_bday,
                'ofw_agency'=> $request->ofw_agency,
                'ofw_employer'=> $request->ofw_employer,
                'ofw_country'=> $request->ofw_country,
                'ofw_job'   => $request->ofw_job,
            ]);

            $requestNumber->requestOfwAddress->update([
                'province' => $request->ofw_province_name,
                'municipality' => $request->ofw_municipality_name,
                'brgy' => $request->ofw_barangay_name,
                'house_no' => $request->ofw_house_no,
                'zip_code' => $request->ofw_zip_code
            ]);

            DB::commit();

            return redirect()
                ->route('forms-submitted.show', $requestId)
                ->with('success', 'Form updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    /*
    |-------------------------------------------------------
    | GENERAL — Static landing page
    |-------------------------------------------------------
    */
    // public function generalFormSubmitted()
    // {
    //     return view('forms-submitted.general');
    // }
}
