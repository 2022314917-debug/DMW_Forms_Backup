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

class SubmittedFormController extends Controller
{
    public function index()
    {
        $requests = Request_Number::latest()->paginate(10);

        return view('forms-submitted.index', compact('requests'));
    }


    /**
     * Show list of submitted GENERAL forms
     */
    public function general()
    {
        $requests = Request_Number::with([
            'requestParty',
            'requestOFW'
        ])
        ->latest()
        ->paginate(10);

        return view('forms-submitted.general.index', compact('requests'));
    }


    /**
     * Show specific GENERAL form
     */
    public function showGeneral($id){
        // Main request
        $request = Request_Number::findOrFail($id);

        // Party info
        $party = Request_Party::where('request_id', $id)->first();

        // Party address
        $address = Request_Party_Address::where('request_id', $id)->first();

        // OFW info
        $ofw = Request_OFW::where('request_id', $id)->first();

        // Section C values
        $sectionC = DB::table('request_form_entries as rfe')
            ->join('request_form_field_values as rffv', 'rffv.request_form_entry_id', '=', 'rfe.id')
            ->join('request_form_field as rff', 'rff.id', '=', 'rffv.request_form_field_id')
            ->where('rfe.request_id', $id)
            ->select(
                'rff.field_name',
                'rff.field_label',
                'rffv.value'
            )
            ->get()
            ->keyBy('field_name'); // IMPORTANT

        return view('forms-submitted.general', compact(
            'request',
            'party',
            'address',
            'ofw',
            'sectionC'
        ));
    }
}
