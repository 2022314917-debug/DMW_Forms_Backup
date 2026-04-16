@extends('layouts.app')

@section('content')

<div class="container mt-4">

    {{-- PAGE TITLE --}}
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">Request #{{ $request->id }}</h4>
        <a href="{{ route('forms-submitted.index') }}" class="btn btn-secondary btn-sm">
            &larr; Back to List
        </a>
    </div>

    @php
        $ofw   = $request->requestOfw;
        $party = $request->requestParty;

        $ofwName = trim(collect([
            $ofw->ofw_fname  ?? '',
            $ofw->ofw_mname  ?? '',
            $ofw->ofw_lname  ?? '',
        ])->filter()->implode(' ')) ?: 'N/A';

        $partyName = trim(collect([
            $party->party_fname  ?? '',
            $party->party_mname  ?? '',
            $party->party_lname  ?? '',
        ])->filter()->implode(' ')) ?: 'N/A';
    @endphp

    {{-- HEADER CARD --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <p class="mb-1"><strong>OFW Name:</strong></p>
                    <p class="text-muted">{{ $ofwName }}</p>
                </div>
                <div class="col-md-4">
                    <p class="mb-1"><strong>Party Name:</strong></p>
                    <p class="text-muted">{{ $partyName }}</p>
                </div>
                <div class="col-md-4">
                    <p class="mb-1"><strong>Status:</strong></p>
                    <span class="badge bg-primary fs-6">{{ $request->status }}</span>
                </div>
            </div>
        </div>
    </div>

    <hr>

    {{-- FORMS TABLE --}}
    <h5 class="mb-3">Submitted Forms</h5>

    @if($forms->isEmpty())
        <div class="alert alert-warning">
            No forms found for this request.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Form Name</th>
                        <th>Date Submitted</th>
                        <th style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($forms as $formId => $entries)
                        @php
                            $formName = optional(
                                optional(
                                    optional($entries->first())->field
                                )->form
                            )->form_name ?? 'Unknown Form';
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $formName }}</td>
                            <td>{{ $request->created_at->format('M d, Y h:i A') }}</td>
                            <td>
                                <a href="{{ route('forms-submitted.open-form', [
                                    'requestId' => $request->id,
                                    'formId'    => $formId,
                                ]) }}" class="btn btn-primary btn-sm">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>

@endsection