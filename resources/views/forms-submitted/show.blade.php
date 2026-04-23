@extends('layouts.app')

@section('content')

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

    $status = strtoupper($request->status ?? 'PENDING');

    $headerColors = [
        'APPROVED'   => ['bg' => '#d4edda', 'border' => '#28a745', 'text' => '#155724'],
        'PENDING'    => ['bg' => '#fff3cd', 'border' => '#ffc107', 'text' => '#856404'],
        'PROCESSING' => ['bg' => '#cce5ff', 'border' => '#4e73df', 'text' => '#004085'],
        'DECLINED'   => ['bg' => '#f8d7da', 'border' => '#dc3545', 'text' => '#721c24'],
        'REJECTED'   => ['bg' => '#f8d7da', 'border' => '#dc3545', 'text' => '#721c24'],
    ];

    $colors = $headerColors[$status] ?? ['bg' => '#e2e3e5', 'border' => '#6c757d', 'text' => '#383d41'];
@endphp

<style>
    body {
        /* background-color: #f4f6f9; */
        font-family: 'Segoe UI', sans-serif;
    }

    .request-wrapper {
        /* max-width: 960px; */
        max-width: 97%;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .header-card {
        border-radius: 10px;
        padding: 1.1rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    }

    .header-card .status-block {
        min-width: 130px;
    }

    .header-card .status-label {
        font-size: 1.15rem;
        font-weight: 700;
        letter-spacing: .5px;
    }

    .header-card .request-no {
        font-size: 0.85rem;
        font-weight: 600;
        margin-top: 2px;
    }

    .header-card .info-block {
        display: flex;
        flex-direction: column;
        gap: 4px;
        flex: 1;
        padding: 0 1.5rem;
    }

    .header-card .info-row {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
    }

    .header-card .info-label {
        font-weight: 700;
        white-space: nowrap;
    }

    .header-card .datetime-block {
        font-size: 0.88rem;
        font-weight: 600;
        white-space: nowrap;
        text-align: right;
    }

    .info-divider {
        width: 2px;
        align-self: stretch;
        border-radius: 2px;
        min-height: 40px;
    }

    .section-title {
        font-size: 1rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.75rem;
    }

    .forms-table {
        width: 100%;
        /* border-collapse: collapse; */
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
        overflow: hidden;
    }

    .forms-table thead tr {
        /* background: #f8f9fb; */
         background: #ffffff;
        border-bottom: 1.5px solid #eef0f3;
    }

    .forms-table thead th {
        padding: 0.85rem 1.2rem;
        font-size: 0.8rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        white-space: nowrap;
        user-select: none;
    }

    .forms-table thead th .sort-arrow {
        display: inline-block;
        margin-left: 4px;
        color: #b0b8c4;
        font-size: 0.75rem;
        vertical-align: middle;
    }

    .forms-table tbody tr {
        border-bottom: 1px solid #f0f2f5;
        transition: background 0.15s;
    }

    .forms-table tbody tr:last-child {
        border-bottom: none;
    }

    .forms-table tbody tr:nth-child(odd) {
        background: #f7f9fc;
    }

    .forms-table tbody tr:nth-child(even) {
        
        background: #ffffff;
    }


    .forms-table td {
        padding: 0.9rem 1.2rem;
        font-size: 0.875rem;
        color: #374151;
        vertical-align: middle;
    }

    .badge-status {
        display: inline-block;
        padding: 0.3rem 0.85rem;
        border-radius: 6px;
        font-size: 0.78rem;
        font-weight: 600;
        letter-spacing: 0.01em;
        white-space: nowrap;
    }

    .badge-pending    { background: #fff3cd; color: #856404; border: 1px solid #ffc107; }
    .badge-processing { background: #cce5ff; color: #004085; border: 1px solid #4e73df; }
    .badge-approved   { background: #d4edda; color: #155724; border: 1px solid #28a745; }
    .badge-declined   { background: #f8d7da; color: #721c24; border: 1px solid #dc3545; }
    .badge-rejected   { background: #f8d7da; color: #721c24; border: 1px solid #dc3545; }

    .btn-view {
        background: #4e73df;
        color: #fff;
        border: none;
        padding: 4px 14px;
        border-radius: 5px;
        font-size: 0.78rem;
        font-weight: 600;
        text-decoration: none;
        transition: background .2s;
        display: inline-block;
    }
    .btn-view:hover { background: #3a5bbf; color: #fff; text-decoration: none; }

    .btn-edit {
        background: #F4A62A;
        color: #fff;
        border: none;
        padding: 4px 14px;
        border-radius: 5px;
        font-size: 0.78rem;
        font-weight: 600;
        text-decoration: none;
        transition: background .2s;
        display: inline-block;
    }
    .btn-edit:hover { background: #d4891a; color: #fff; text-decoration: none; }

    .back-link {
        display: inline-block;
        margin-bottom: 1rem;
        font-size: 0.85rem;
        color: #4e73df;
        text-decoration: none;
        font-weight: 600;
    }
    .back-link:hover { text-decoration: underline; }

    .division-text {
        font-size: 0.8rem;
        color: #666;
    }
</style>

<div class="request-wrapper">
    <div class="position-relative d-flex align-items-center justify-content-center mb-3" style="min-height: 38px;">
        <a href="{{ route('forms-submitted.index') }}" class="btn btn-secondary btn-sm position-absolute start-0 d-flex align-items-center gap-1"
            style="border-radius: 6px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>Back to List
        </a>
    </div>
   

    {{--
        Colors are passed via data-* attributes (no CSS/style context = no linter errors).
        A small script block below reads them and applies the styles at runtime.
    --}}
    <div class="header-card"
         data-bg="{{ $colors['bg'] }}"
         data-border="{{ $colors['border'] }}"
         data-color="{{ $colors['text'] }}">

        <div class="status-block">
            <div class="status-label">{{ $status }}</div>
            <div class="request-no">Request No. : #{{ $request->id }}</div>
        </div>

        <div class="info-divider"></div>

        <div class="info-block">
            <div class="info-row">
                <span class="info-label">OFW Name:</span>
                <span>{{ $ofwName }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Party Name:</span>
                <span>{{ $partyName }}</span>
            </div>
        </div>

        <div class="info-divider"></div>

        <div class="datetime-block">
            {{ $request->created_at->format('M d, Y | h:i A') }}
        </div>
    </div>

    <script>
        (function () {
            var card   = document.querySelector('.header-card');
            var bg     = card.dataset.bg;
            var border = card.dataset.border;
            var color  = card.dataset.color;

            card.style.backgroundColor = bg;
            card.style.border          = '2px solid ' + border;
            card.style.color           = color;

            card.querySelectorAll('.info-divider').forEach(function (el) {
                el.style.backgroundColor = border;
            });
        })();
    </script>

    {{-- FORMS TABLE --}}
    <div class="section-title">Submitted Forms</div>

    @if($forms->isEmpty())
        <div class="alert alert-warning">No forms found for this request.</div>
    @else
        <div class="table-responsive">
            <table class="forms-table">
                <thead>
                    <tr>
                        <th>Form Names</th>
                        <th>Division <span class="sort-arrow">&#9660;</span></th>
                        <th>Status <span class="sort-arrow">&#9660;</span></th>
                        <th>Date Submitted <span class="sort-arrow">&#9660;</span></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($forms as $formId => $data)
                        @php
                            $rowStatus = strtolower($data['status'] ?? 'pending');
                            $divisionName = $data['form']->division->division_name ?? $data['form']->division ?? '—';

                            $editRoutes = [
                                'General' => 'forms-submitted.edit.general',
                                'OFW Info Sheet MWPD' => 'forms-submitted.edit.ofw_info_sheet_mwpd',
                                'OFW Info Sheet MWPD Protection' => 'forms-submitted.edit.general.ofw_info_sheet_mwpd_protection',
                                'Aksyon' => 'forms-submitted.edit.general.aksyon',
                                'SINGLE-ENTRY APPROACH (SENA)' => 'forms-submitted.edit.sena',
                            ];

                            $formName = $data['form']->form_name;
                            $editRoute = $editRoutes[$formName] ?? 'forms-submitted.edit.general';
                        @endphp
                        <tr>
                            <td>{{ $data['form']->form_name }}</td>
                            <td class="division-text">{{ $divisionName }}</td>
                            <td>
                                <span class="badge-status badge-{{ $rowStatus }}">
                                    {{ ucfirst($data['status']) }}
                                </span>
                            </td>
                            <td>{{ $request->created_at->format('M d, Y | h:i A') }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('forms-submitted.open-form', [
                                        'requestId' => $request->id,
                                        'formId'    => $formId,
                                    ]) }}" class="btn-view">View</a>
                                    <a href="{{ route($editRoute, [
                                        'requestId' => $request->id,
                                        'formId'    => $formId,
                                    ]) }}" class="btn-edit">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>

@endsection