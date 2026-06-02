@extends('layouts.app')

@section('content')

@php
    $ofw   = $requestNumber->requestOfw;
    $party = $requestNumber->requestParty;

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

    $status = strtoupper($requestNumber->status ?? 'PENDING');

    $headerColors = [
        'APPROVED'   => ['bg' => '#d4edda', 'border' => '#28a745', 'text' => '#155724'],
        'NEW_SUBMISSION'    => ['bg' => '#fff3cd', 'border' => '#ffc107', 'text' => '#856404'],
        'FORMS_REQUESTED' => ['bg' => '#cce5ff', 'border' => '#4e73df', 'text' => '#004085'],
        'SUBMITTED_FOR_REVIEW' => ['bg' => '#cce5ff', 'border' => '#4e73df', 'text' => '#004085'],
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

    .btn-update-status{
        background-color: #3458c2;
        color: #fff;
        border: #3458c2;
        padding: 7px 15px;
        border-radius: 5px;
        font-size: 0.78rem;
        font-weight: 600;
        text-decoration: none;
        transition: background .2s;
        display: inline-block;
    }

    .btn-update-status:hover{
        background-color: #173799;
    }

    .btn-status-action {
        border: none;
        padding: 0.5rem 1.2rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: opacity 0.2s, transform 0.1s;
    }
    .btn-status-action:hover { opacity: 0.88; transform: translateY(-1px); }
    .btn-status-action:active { transform: translateY(0); }
    .btn-status-action:disabled { opacity: 0.55; cursor: not-allowed; transform: none; }

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

    <div class="">
        <div class="d-flex align-items-center gap-2 mb-3" style="min-height: 38px;">
            <a href="{{ route('forms-submitted.index') }}" class="btn btn-secondary btn-sm d-flex align-items-center gap-1"
                style="border-radius: 6px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>Back to List
            </a>

            @if(($requestNumber->status) === "NEW_SUBMISSION")
                <button class="btn-update-status" id="btnOpenStatusModal">Update Status</button>
            @endif
        </div>
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
            <div class="request-no">Request No. : #{{ $requestNumber->id }}</div>
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

        <div class="">
            <div class="datetime-block">
                {{ $requestNumber->created_at->format('M d, Y | h:i A') }}
            </div>
            @if(($requestNumber->status) !== "NEW_SUBMISSION")
                <div>
                    <span class="info-label">Evaluated by:</span> {{ $evaluator ? trim($evaluator->emp_fname . ' ' . $evaluator->emp_lname) : 'N/A' }}
                </div>
            @endif
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
    <div class="flex items-center justify-between">
        <div class="section-title">
            Submitted Forms
        </div>

    </div>
        
    
    @if($forms->isEmpty())
        <div class="alert alert-warning">No forms found for this request.</div>
    @else
        <div class="table-responsive">
            <table class="forms-table">
                <thead>
                    <tr>
                        <th>Form Names</th>
                        <th>Division <span class="sort-arrow">&#9660;</span></th>
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
                                'REQUEST FOR ASSISTANCE (RFA) FORM' => 'forms-submitted.edit.rfa',
                                'REQUEST FOR VERIFICATION / CERTIFICATION OF OFW RECORDS' => 'forms-submitted.edit.processing',
                                'OFW Info Sheet MWPD Protection' => 'forms-submitted.edit.general.ofw_info_sheet_mwpd_protection',
                                'AKSYON FORM' => 'forms-submitted.edit.aksyon',
                                'SINGLE-ENTRY APPROACH (SENA)' => 'forms-submitted.edit.sena',
                                'ELPOR FORM' => 'forms-submitted.edit.elpor',
                                'OFW STATEMENT FORM' => 'forms-submitted.edit.ofw_statement',
                                'ELPOR B1 FORM' => 'forms-submitted.edit.elporb1',
                                'BUSINESS CANVAS FORM' => 'forms-submitted.edit.business_canvas'
                            ];

                            $formName = $data['form']->form_name;
                            $editRoute = $editRoutes[$formName] ?? 'forms-submitted.edit.general';
                        @endphp
                        <tr>
                            <td>{{ $data['form']->form_name }}</td>
                            <td class="division-text">{{ $divisionName }}</td>
                            <td>{{ $requestNumber->created_at->format('M d, Y | h:i A') }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('forms-submitted.open-form', [
                                        'requestId' => $requestNumber->id,
                                        'formId'    => $formId,
                                    ]) }}" class="btn-view">View</a>
                                    <a href="{{ route($editRoute, [
                                        'requestId' => $requestNumber->id,
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

    {{-- REQUIREMENTS TABLE --}}
        <div class="section-title mt-4">Submitted Requirements</div>

        @php
            $requirements = $requestNumber->requirements ?? collect();
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

    {{-- SPINNER OVERLAY --}}
    <div id="spinnerOverlay" style="display:none; position:fixed; z-index:10000; inset:0;
        background:rgba(0,0,0,0.55); align-items:center; justify-content:center;">
        <div style="background:#fff; border-radius:12px; padding:2rem 2.5rem;
                    display:flex; flex-direction:column; align-items:center; gap:1rem;
                    min-width:220px; box-shadow:0 8px 32px rgba(0,0,0,0.18);">
            <div id="spinnerRing" style="width:44px; height:44px; border:4px solid #e2e8f0;
                border-top-color:#3458c2; border-radius:50%;
                animation:spinAnim 0.75s linear infinite;"></div>
            <div id="spinnerText" style="font-size:14px; color:#555; font-weight:600;">Updating status…</div>
        </div>
    </div>

    {{-- TOAST CONTAINER --}}
    <div id="toastContainer" style="position:fixed; top:1.5rem; right:1.5rem;
        z-index:11000; display:flex; flex-direction:column; gap:10px; min-width:320px;"></div>

    <style>
        @keyframes spinAnim { to { transform: rotate(360deg); } }
        @keyframes toastIn  { from { opacity:0; transform:translateY(16px); } to { opacity:1; transform:translateY(0); } }
    </style>

    <div id="filePreviewModal" class="custom-modal">
        <div class="custom-modal-content">
            <span class="close-modal">&times;</span>

            <div id="previewContainer">
                <!-- AJAX content will be injected here -->
            </div>
        </div>
    </div>

    {{-- STATUS MODAL --}}
    <div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-2 overflow-hidden">

                {{-- Header --}}
                <div class="modal-header border-0 px-4 py-3" style="background-color: #3458c2;">
                    <h5 class="modal-title fw-bold text-white mb-0">Update Request Status</h5>
                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>

                {{-- Body --}}
                <div class="modal-body px-4 pt-4 pb-4">

                    <div id="statusModalMsg" class="alert d-none" role="alert"></div>

                    {{-- Info Rows --}}
                    <div class="mb-2 d-flex">
                        <span class="fw-semibold text-secondary" style="width:110px;">Request No.</span>
                        <span class="me-2 text-secondary">:</span>
                        <span id="modalRequestNo">{{ $requestNumber->id }}</span>
                    </div>
                    <div class="mb-2 d-flex">
                        <span class="fw-semibold text-secondary" style="width:110px;">OFW Name</span>
                        <span class="me-2 text-secondary">:</span>
                        <span id="modalOfwName">{{ $requestNumber->requestOfw->ofw_fname }} {{ $requestNumber->requestOfw->ofw_mname }} {{ $requestNumber->requestOfw->ofw_lname }} </span>
                    </div>
                    <div class="mb-4 d-flex">
                        <span class="fw-semibold text-secondary" style="width:110px;">Party Name</span>
                        <span class="me-2 text-secondary">:</span>
                        <span id="modalPartyName">{{ $requestNumber->requestParty->party_fname ?? '' }} {{ $requestNumber->requestParty->party_mname ?? '' }} {{ $requestNumber->requestParty->party_lname ?? '' }}</span>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="d-flex gap-3 justify-content-center">
                        <button id="btnReject"
                                class="btn px-5 py-2 fw-bold text-white rounded-3"
                                style="background-color: #c94c4c;">
                            Reject
                        </button>
                        <button id="btnApprove"
                                class="btn px-5 py-2 fw-bold text-white rounded-3"
                                style="background-color: #3458c2;">
                            Approve
                        </button>

                        
                    </div>

                </div>
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

    // ── Bootstrap Status Modal ─────────────────────────────
    const statusModalEl = document.getElementById('statusModal');
    const statusModal = new bootstrap.Modal(statusModalEl);

    const btnOpenStatus = document.getElementById('btnOpenStatusModal');
    const statusMsg = document.getElementById('statusModalMsg');

    // const requestId = @json($requestNumber->id);
    const requestId = "{{ $requestNumber->id }}";

    function showStatusMsg(text, type) {

        statusMsg.classList.remove('d-none', 'alert-success', 'alert-danger');

        statusMsg.textContent = text;

        if (type === 'success') {
            statusMsg.classList.add('alert-success');
        } else {
            statusMsg.classList.add('alert-danger');
        }
    }

    function setStatusBtnsDisabled(state) {

        ['btnApprove', 'btnReject'].forEach(id => {
            document.getElementById(id).disabled = state;
        });
    }

    function showToast(title, message, type) {
        const colors = type === 'success'
            ? { bg:'#d4edda', border:'#28a745', text:'#155724', icon:'✔' }
            : { bg:'#f8d7da', border:'#dc3545', text:'#721c24', icon:'✖' };

        const toast = document.createElement('div');
        toast.style.cssText = `
            display:flex; align-items:flex-start; gap:12px; padding:14px 18px;
            border-radius:10px; font-family:'Segoe UI',sans-serif;
            background:${colors.bg}; border:1.5px solid ${colors.border};
            color:${colors.text}; animation:toastIn 0.25s ease;
            box-shadow:0 4px 16px rgba(0,0,0,0.12);
        `;
        toast.innerHTML = `
            <span style="font-size:18px; margin-top:1px;">${colors.icon}</span>
            <div style="flex:1;">
                <div style="font-weight:700; font-size:13px;">${title}</div>
                <div style="font-size:12px; margin-top:3px; opacity:0.85;">${message}</div>
            </div>
            <span style="cursor:pointer; font-size:18px; opacity:0.5; margin-left:4px; line-height:1;"
                onclick="this.closest('div[style]').remove()">&times;</span>
        `;

        document.getElementById('toastContainer').appendChild(toast);

        setTimeout(() => {
            toast.style.transition = 'opacity 0.3s, transform 0.3s';
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(-8px)';
            setTimeout(() => toast.remove(), 320);
        }, 4500);
    }

    function showSpinner(text) {
        document.getElementById('spinnerText').textContent = text || 'Updating status…';
        document.getElementById('spinnerOverlay').style.display = 'flex';
    }

    function hideSpinner() {
        document.getElementById('spinnerOverlay').style.display = 'none';
    }

    function callStatusAction(action) {
        const url = action === 'approve'
            ? "{{ route('forms-submitted.request-approve', $requestNumber->id) }}"
            : "{{ route('forms-submitted.request-reject', $requestNumber->id) }}";

        statusModal.hide();                             // close the status modal
        showSpinner(action === 'approve' ? 'Approving request…' : 'Rejecting request…');

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify({ request_id: requestId }),
            credentials: 'same-origin',
        })
        .then(res => res.json())
        .then(data => {
            hideSpinner();
            if (data.success) {
                showToast(
                    'Status updated successfully',
                    'An email notification has been sent to the OFW.',
                    'success'
                );
                setTimeout(() => window.location.reload(), 2200);
            } else {
                showToast(
                    'Update failed',
                    data.message ?? 'Something went wrong. Please try again.',
                    'error'
                );
            }
        })
        .catch(() => {
            hideSpinner();
            showToast('Request failed', 'Could not connect. Please try again.', 'error');
        });
    }

    btnOpenStatus.addEventListener('click', () => {

        statusMsg.classList.add('d-none');

        setStatusBtnsDisabled(false);

        statusModal.show();
    });

    document.getElementById('btnApprove')
        .addEventListener('click', () => callStatusAction('approve'));

    document.getElementById('btnReject')
        .addEventListener('click', () => callStatusAction('reject'));

    

});
</script>

@endsection