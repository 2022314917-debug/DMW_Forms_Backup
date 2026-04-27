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
        box-shadow: -6px 0 10px rgba(0, 0, 0, 0.06),
                 6px 0 10px rgba(0, 0, 0, 0.06);
        overflow: visible;
    }

    .forms-table thead tr {
        background: #f0f2f8;
        border-bottom: 2px solid #e2e6f0;
        box-shadow: 0 3px 8px rgba(78, 115, 223, 0.12),
                    0 1px 3px rgba(0, 0, 0, 0.08);
        position: relative;
        z-index: 1;
    }

    .forms-table thead th {
        padding: 0.85rem 1.2rem;
        font-size: 0.8rem;
        font-weight: 700;
        color: #3d4a6b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
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

    /* .forms-table tbody tr:nth-child(odd) {
        background: #ffffff;
    }

    .forms-table tbody tr:nth-child(even) {
        
        background: #f7f9fc;
    } */

    .forms-table tbody tr {
        background: #ffffff;
    }
    .forms-table tbody tr.row-alt {
        background: #f7f9fc;
    }


    .forms-table td {
        padding: 0.9rem 1.2rem;
        font-size: 0.875rem;
        color: #374151;
        vertical-align: middle;
        text-align: left
    }

    .forms-table td:last-child {
        text-align: center;
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

    .custom-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.6);
    }

    .custom-modal-content {
        background: #fff;
        margin: 5% auto;
        padding: 1rem;
        width: 80%;
        max-width: 900px;
        border-radius: 10px;
        position: relative;
    }

    .close-modal {
        position: absolute;
        right: 15px;
        top: 10px;
        font-size: 22px;
        cursor: pointer;
    }

    #previewContainer {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 70vh;
        overflow: auto;
    }

    #previewContainer img {
        max-width: 100%;
        max-height: 70vh;
        width: auto;
        height: auto;
        object-fit: contain;
        border-radius: 6px;
    }

    #previewContainer iframe {
        width: 100%;
        height: 70vh;
        border: none;
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
                                'OFFICIAL DMW-RO3 RFA FORM' => 'forms-submitted.edit.general',
                                'REQUEST FOR VERIFICATION / CERTIFICATION OF OFW RECORDS' => 'forms-submitted.edit.processing',
                                'OFW Info Sheet MWPD Protection' => 'forms-submitted.edit.general.ofw_info_sheet_mwpd_protection',
                                'REQUEST FOR ASSISTANCE (RFA) FORM' => 'forms-submitted.edit.aksyon',
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
                                    <a href="" class="btn-edit">Status</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- REQUIREMENTS TABLE --}}
        <div class="section-title mt-4">Submitted Requirements</div>

        @php
            $requirements = $request->requirements ?? collect();
            $groupedRequirements = $requirements->groupBy('file_type');
        @endphp

        @if($requirements->isEmpty())
            <div class="alert alert-warning">No requirements uploaded for this request.</div>
        @else
            <div class="table-responsive">
                <table class="forms-table">
                    <thead>
                        <tr>
                            <th>Document Type</th>
                            <th>File Name <span class="sort-arrow">&#9660;</span></th>
                            <th>Action</th>
                        </tr>
                    </thead>



                    <tbody>
                        @foreach($groupedRequirements as $type => $files)
                            @php
                                $rowCount = $files->count();
                            @endphp

                            @foreach($files as $index => $requirement)
                                @php
                                    $ext = strtolower(pathinfo($requirement->file_name, PATHINFO_EXTENSION));

                                    $iconClass = in_array($ext, ['jpg','jpeg','png'])
                                        ? 'fas fa-file-image text-success'
                                        : ($ext === 'pdf'
                                            ? 'fas fa-file-pdf text-danger'
                                            : 'fas fa-file text-secondary');
                                @endphp

                                <tr>
                                    {{-- DOCUMENT TYPE (rowspan like your image) --}}
                                    @if($index === 0)
                                        <td rowspan="{{ $rowCount }}" style="vertical-align: middle; font-weight: 600;">
                                            {{ $type }}
                                        </td>
                                    @endif

                                    {{-- FILE NAME --}}
                                    <td>
                                        <i class="{{ $iconClass }} me-1"></i>
                                        {{ $requirement->file_name }}
                                    </td>

                                    {{-- ACTION --}}
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center text-center">

                                            <a href="javascript:void(0)"
                                            class="btn-table-view btn-preview"
                                            data-file="{{ route('requirements.view', $requirement->id) }}">
                                                VIEW
                                            </a>

                                            <a href=""
                                            class="btn-table-download"
                                            data-file="{{ route('requirements.download', $requirement->id) }}">
                                                DOWNLOAD
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div> {{-- end request-wrapper --}}

    <div id="filePreviewModal" class="custom-modal">
        <div class="custom-modal-content">
            <span class="close-modal">&times;</span>

            <div id="previewContainer">
                <!-- AJAX content will be injected here -->
            </div>
        </div>
    </div>

</div>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const modal = document.getElementById("filePreviewModal");
    const previewContainer = document.getElementById("previewContainer");
    const closeBtn = document.querySelector(".close-modal");

    document.querySelectorAll(".btn-preview").forEach(button => {
        button.addEventListener("click", function () {

            const apiUrl = this.dataset.file;

            fetch(apiUrl)
                .then(res => res.json())
                .then(data => {

                    const fileUrl = data.url;
                    const ext = fileUrl.split('.').pop().toLowerCase();

                    let content = '';

                    if (['jpg','jpeg','png','gif','webp'].includes(ext)) {
                        content = `<img src="${fileUrl}" alt="Preview">`;
                    } 
                    else if (ext === 'pdf') {
                        content = `<iframe src="${fileUrl}#toolbar=1"></iframe>`;
                    } 
                    else if (['doc','docx'].includes(ext)) {
                        content = `<iframe src="https://docs.google.com/gview?url=${encodeURIComponent(fileUrl)}&embedded=true"></iframe>`;
                    } 
                    else {
                        content = `
                            <div style="text-align:center; padding:2rem;">
                                <p>Preview not available</p>
                                <a href="${fileUrl}" target="_blank" class="btn-view">Open File</a>
                            </div>
                        `;
                    }

                    previewContainer.innerHTML = content;
                    modal.style.display = "block";
                });
        });
    });

    document.querySelectorAll(".btn-table-download").forEach(button => {
        button.addEventListener("click", function (e) {
            e.preventDefault();

            const apiUrl = this.dataset.file;

            fetch(apiUrl)
                .then(res => res.json())
                .then(data => {
                    const link = document.createElement('a');
                    link.href = data.url;
                    link.download = data.name;
                    link.target = '_blank';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                });
        });
    });

    closeBtn.onclick = function () {
        modal.style.display = "none";
        previewContainer.innerHTML = '';
    };

    window.onclick = function (e) {
        if (e.target === modal) {
            modal.style.display = "none";
            previewContainer.innerHTML = '';
        }
    };

    fetch(fileUrl)
    .then(res => res.json())
    .then(data => {

        const url = data.url;
        const ext = url.split('.').pop().toLowerCase();

        let content = '';

        if (['jpg','jpeg','png','gif','webp'].includes(ext)) {
            content = `<img src="${url}">`;
        }
        else if (ext === 'pdf') {
            content = `<iframe src="${url}"></iframe>`;
        }
        else {
            content = `<a href="${url}" target="_blank">Open File</a>`;
        }

        previewContainer.innerHTML = content;
        modal.style.display = "block";
    });

});
</script>

@endsection