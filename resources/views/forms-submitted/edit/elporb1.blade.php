@extends('layouts.app')

@section('content')

<style>
    body {
        background-color: #f4f4f4;
        font-family: 'Assistant', Arial, sans-serif;
    }

    .form-header {
        background-color: #e2e2e2;
        padding: 1rem;
        border-radius: 0.25rem;
        margin-bottom: 1rem;
        border: 1px solid #ccc;
    }

    .form-section {
        background-color: #d9e4f5;
        padding: 1rem;
        border-radius: 0.25rem;
        margin-bottom: 1rem;
        border: 1px solid #b0c4de;
    }

    .form-section h5 {
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .form-control::placeholder {
        font-size: 0.85rem;
    }

    .form-label {
        font-weight: 500;
    }

    .page-title {
        font-weight: 700;
        font-size: 1.15rem;
        letter-spacing: 0.03em;
        text-align: center;
        margin-bottom: 1.25rem;
        text-transform: uppercase;
    }

    .section-heading {
        font-weight: 700;
        font-size: 1rem;
        text-transform: uppercase;
        margin-bottom: 1rem;
    }

    .supply-table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        font-size: 0.82rem;
    }

    .supply-table th {
        background-color: #c8d8f0;
        border: 1px solid #9ab0d0;
        padding: 0.45rem 0.5rem;
        text-align: center;
        font-weight: 700;
        font-size: 0.78rem;
        text-transform: uppercase;
        vertical-align: middle;
    }

    .supply-table td {
        border: 1px solid #9ab0d0;
        padding: 0.35rem 0.5rem;
        vertical-align: middle;
    }

    .supply-table .category-row td {
        background-color: #dce8f8;
        font-weight: 700;
        font-size: 0.78rem;
        text-transform: uppercase;
        padding: 0.3rem 0.5rem;
    }

    .supply-table .data-row td {
        height: 2rem;
        background-color: #fff;
    }

    .supply-table .total-row td {
        background-color: #c8d8f0;
        font-weight: 700;
        text-align: right;
        padding: 0.4rem 0.75rem;
    }

    .btn-add {
        background-color: #3a6fc4;
        color: #fff;
        font-weight: 600;
        font-size: 0.82rem;
        padding: 0.3rem 0.8rem;
        border: none;
        border-radius: 0.25rem;
        letter-spacing: 0.04em;
    }

    .btn-add:hover {
        background-color: #2c5aa0;
        color: #fff;
    }

    .signature-area {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-top: 1.5rem;
        padding: 0 0.5rem;
    }

    .signature-block {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.25rem;
    }

    .signature-block input[type="text"],
    .signature-block input[type="date"] {
        border: 1px solid #9ab0d0;
        border-radius: 0.2rem;
        padding: 0.25rem 0.5rem;
        font-family: 'Assistant', Arial, sans-serif;
        font-size: 0.85rem;
        background-color: #fff;
        min-width: 200px;
    }

    .signature-label {
        font-weight: 600;
        font-size: 0.78rem;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        margin-top: 0.15rem;
    }

    .total-arrow::after {
        content: ' →';
    }

    .modal-header-custom {
        background-color: #3a6fc4;
        color: #fff;
        padding: 0.75rem 1rem;
        border-bottom: none;
    }

    .modal-header-custom .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }

    .modal-header-custom .modal-title {
        font-weight: 700;
        font-size: 0.95rem;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .modal-content {
        border-radius: 0.3rem;
        border: 2px solid #3a6fc4;
        overflow: hidden;
    }

    .modal-body {
        background-color: #f0f5fb;
        padding: 1.25rem 1.5rem;
    }

    .modal-label {
        font-weight: 700;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        color: #1a3a6c;
        margin-bottom: 0.2rem;
        display: block;
    }

    .modal-label span {
        font-weight: 400;
        text-transform: none;
        font-size: 0.73rem;
        color: #555;
    }

    .modal-input {
        width: 100%;
        border: 1px solid #9ab0d0;
        border-radius: 0.2rem;
        padding: 0.3rem 0.5rem;
        font-family: 'Assistant', Arial, sans-serif;
        font-size: 0.85rem;
        background-color: #fff;
        box-sizing: border-box;
    }

    .modal-input:focus {
        outline: none;
        border-color: #3a6fc4;
        box-shadow: 0 0 0 2px rgba(58,111,196,0.15);
    }

    .modal-footer-custom {
        background-color: #f0f5fb;
        border-top: 1px solid #b0c4de;
        justify-content: flex-end;
        padding: 0.6rem 1rem;
    }

    .btn-modal-add {
        background-color: #3a6fc4;
        color: #fff;
        font-weight: 600;
        font-size: 0.82rem;
        padding: 0.3rem 1.4rem;
        border: none;
        border-radius: 0.25rem;
    }

    .btn-modal-add:hover {
        background-color: #2c5aa0;
        color: #fff;
    }

    .btn-confirm {
        background-color: #2F5BB7;
        border-color: #2F5BB7;
        color: #fff;
    }

    .btn-confirm:hover {
        background-color: #24448f;
        border-color: #24448f;
        color: #fff;
    }
</style>

{{-- Toast --}}
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
    <div id="resultToast" class="toast text-white align-items-center border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="toastMessage"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<div class="container py-4">

    <div class="position-relative d-flex align-items-center justify-content-center mb-3" style="min-height: 38px;">
        <a href="{{ route('forms-submitted.show', $request->id) }}"
          class="btn btn-secondary btn-sm position-absolute start-0 d-flex align-items-center gap-1"
          style="border-radius: 6px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
            Back to Request
        </a>
        <h4 class="h2 mb-0 fw-bold">REQUEST #{{ $request->id }}</h4>
    </div>

    {{-- Page Title --}}
    <div class="page-title">
        Listahan ng Panimulang Kagamitan at Produkto
    </div>

    <form method="POST"
          action="{{ route('forms-submitted.save-edit-elporb1', ['requestId' => $request->id, 'formId' => $formId]) }}"
          id="elporB1Form"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Dirty flag — flipped to 1 whenever the table is changed --}}
        <input type="hidden" name="items_modified" id="itemsModified" value="0">

        <div class="form-section">
            <div class="section-heading">
                Mga Supply sa Loob ng Isang Buwan at mga Kagamitan
            </div>

            {{-- Add Button --}}
            <div class="d-flex justify-content-end mb-2">
                <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#addItemModal">
                    + ADD
                </button>
            </div>

            {{-- Supply Table --}}
            <div class="table-responsive">
                <table class="supply-table" id="supplyTable">
                    <thead>
                        <tr>
                            <th style="width: 20%;">Pangalan ng Supplier</th>
                            <th style="width: 22%;">Item / Produktong Bibilhin</th>
                            <th style="width: 18%;">
                                Magkano Bawat Item
                                <br><span style="font-weight:400;font-size:0.7rem;text-transform:none;">(orihinal na presyo)</span>
                            </th>
                            <th style="width: 14%;">
                                Bilang
                                <br><span style="font-weight:400;font-size:0.7rem;text-transform:none;">(ilang item / produktong kinuha)</span>
                            </th>
                            <th style="width: 18%;">Kabuuang Halaga ng Bawat Item</th>
                            <th style="width: 8%;"></th>
                        </tr>
                    </thead>
                    <tbody id="supplyBody">

                        {{-- PRODUKTO Category --}}
                        <tr class="category-row" id="produktoCategory">
                            <td colspan="6">Produkto</td>
                        </tr>

                        @php $items = $startup_items ?? collect(); @endphp

                        @foreach($items as $index => $row)
                            @if($row->item_category === 'produkto')
                                <tr class="data-row"
                                    data-category="{{ $row->item_category }}"
                                    data-supplier="{{ $row->supplier_name }}"
                                    data-item="{{ $row->item_name }}"
                                    data-price="{{ $row->item_price }}"
                                    data-qty="{{ $row->item_qty }}"
                                    data-total="{{ $row->item_total }}">
                                    <td>
                                        {{ $row->supplier_name }}
                                        <input type="hidden" name="items[{{ $index }}][category]"       value="{{ $row->item_category }}">
                                        <input type="hidden" name="items[{{ $index }}][supplier_name]"  value="{{ $row->supplier_name }}">
                                        <input type="hidden" name="items[{{ $index }}][item_name]"      value="{{ $row->item_name }}">
                                        <input type="hidden" name="items[{{ $index }}][item_price]"     value="{{ $row->item_price }}">
                                        <input type="hidden" name="items[{{ $index }}][item_qty]"       value="{{ $row->item_qty }}">
                                        <input type="hidden" name="items[{{ $index }}][item_total]"     value="{{ $row->item_total }}">
                                    </td>
                                    <td>{{ $row->item_name }}</td>
                                    <td style="text-align:right;">{{ number_format($row->item_price, 2) }}</td>
                                    <td style="text-align:center;">{{ $row->item_qty }}</td>
                                    <td class="row-kabuuan" data-value="{{ $row->item_total }}" style="text-align:right;">
                                        {{ number_format($row->item_total, 2) }}
                                    </td>
                                    <td style="text-align:center;">
                                        <button type="button" class="btn btn-sm btn-danger remove-btn">×</button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                        {{-- KAGAMITAN Category --}}
                        <tr class="category-row" id="kagamitanCategory">
                            <td colspan="6">Kagamitan</td>
                        </tr>

                        @foreach($items as $index => $row)
                            @if($row->item_category === 'kagamitan')
                                <tr class="data-row"
                                    data-category="{{ $row->item_category }}"
                                    data-supplier="{{ $row->supplier_name }}"
                                    data-item="{{ $row->item_name }}"
                                    data-price="{{ $row->item_price }}"
                                    data-qty="{{ $row->item_qty }}"
                                    data-total="{{ $row->item_total }}">
                                    <td>
                                        {{ $row->supplier_name }}
                                        <input type="hidden" name="items[{{ $index }}][category]"       value="{{ $row->item_category }}">
                                        <input type="hidden" name="items[{{ $index }}][supplier_name]"  value="{{ $row->supplier_name }}">
                                        <input type="hidden" name="items[{{ $index }}][item_name]"      value="{{ $row->item_name }}">
                                        <input type="hidden" name="items[{{ $index }}][item_price]"     value="{{ $row->item_price }}">
                                        <input type="hidden" name="items[{{ $index }}][item_qty]"       value="{{ $row->item_qty }}">
                                        <input type="hidden" name="items[{{ $index }}][item_total]"     value="{{ $row->item_total }}">
                                    </td>
                                    <td>{{ $row->item_name }}</td>
                                    <td style="text-align:right;">{{ number_format($row->item_price, 2) }}</td>
                                    <td style="text-align:center;">{{ $row->item_qty }}</td>
                                    <td class="row-kabuuan" data-value="{{ $row->item_total }}" style="text-align:right;">
                                        {{ number_format($row->item_total, 2) }}
                                    </td>
                                    <td style="text-align:center;">
                                        <button type="button" class="btn btn-sm btn-danger remove-btn">×</button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                        {{-- Total Row --}}
                        <tr class="total-row" id="totalRow">
                            <td colspan="6">
                                <span class="total-arrow">Kabuuang Halaga</span>
                                <span id="grandTotal" style="margin-left:1rem;">0.00</span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            {{-- Signature Area --}}
            <div class="signature-area">
                <div class="signature-block">
                    <input type="text" name="elpor_b1_full_name" class="form-control"
                        value="{{ $entries['elpor_b1_full_name'] ?? '' }}" placeholder="">
                    <div class="form-label">Full Name</div>
                </div>
                <div class="signature-block">
                    <input type="date" name="elpor_b1_date" class="form-control"
                        value="{{ $entries['elpor_b1_date'] ?? '' }}">
                    <div class="form-label">Date</div>
                </div>
            </div>
        </div>

        {{-- Update Button --}}
        <div class="d-flex justify-content-end mt-3 mb-5">
            <button type="button" class="btn btn-confirm px-4" id="updateBtn" onclick="validateAndSubmit()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                    <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                </svg>
                Update Request
            </button>
        </div>

    </form>
</div>

{{-- Add Item Modal --}}
<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:480px;">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title" id="addItemModalLabel">Maglagay ng Produkto / Kagamitan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="addItemError" class="alert alert-danger py-2 px-3 d-none" style="font-size:0.88rem;">
                    Pakisuyo kumpletuhin ang lahat ng fields.
                </div>

                <div class="mb-3">
                    <label class="modal-label">Kategorya</label>
                    <select class="modal-input" id="modalKategorya" style="appearance:auto;">
                        <option value="" disabled selected>PUMILI SA SUMUSUNOD ▼</option>
                        <option value="produkto">Produkto</option>
                        <option value="kagamitan">Kagamitan</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label class="modal-label" for="modalSupplier">Pangalan ng Supplier:</label>
                    <input type="text" class="modal-input" id="modalSupplier">
                </div>
                <div class="mb-2">
                    <label class="modal-label" for="modalItem">Item / Produktong Bibilhin:</label>
                    <input type="text" class="modal-input" id="modalItem">
                </div>
                <div class="mb-2">
                    <label class="modal-label" for="modalPresyo">
                        Magkano Bawat Item: <span>(orihinal na presyo)</span>
                    </label>
                    <input type="number" class="modal-input" id="modalPresyo" min="0" step="0.01">
                </div>
                <div class="mb-2">
                    <label class="modal-label" for="modalBilang">
                        Bilang: <span>(ilang item / produktong kinuha)</span>
                    </label>
                    <input type="number" class="modal-input" id="modalBilang" min="0">
                </div>
                <div class="mb-1">
                    <label class="modal-label" for="modalKabuuan">Kabuuang Halaga ng Bawat Item:</label>
                    <input type="number" class="modal-input" id="modalKabuuan" min="0" step="0.01" readonly
                        style="background-color:#e8eef8;">
                </div>
            </div>
            <div class="modal-footer modal-footer-custom">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn-modal-add" id="confirmAddBtn">Add</button>
            </div>
        </div>
    </div>
</div>

{{-- Confirmation Modal --}}
<div class="modal fade" id="confirmationModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Confirm Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to save the changes to this request?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-confirm btn-sm" id="confirmSubmitBtn">Yes, Update</button>
            </div>
        </div>
    </div>
</div>

{{-- Validation Modal --}}
<div class="modal fade" id="validationModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="me-2 mb-1" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    Incomplete Fields
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2 text-muted small">Please fill in the following required fields before submitting:</p>
                <ul id="validationErrorList" class="mb-0 ps-3 small text-danger"></ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const itemsModified = document.getElementById('itemsModified');

    // ── Grand Total ──────────────────────────────────────────────────────
    function computeGrandTotal() {
        let total = 0;
        document.querySelectorAll('.row-kabuuan').forEach(cell => {
            total += parseFloat(cell.dataset.value) || 0;
        });
        document.getElementById('grandTotal').textContent = total.toFixed(2);
    }

    computeGrandTotal();

    // ── Auto-compute modal total ─────────────────────────────────────────
    function computeModalTotal() {
        const presyo  = parseFloat(document.getElementById('modalPresyo').value) || 0;
        const bilang  = parseFloat(document.getElementById('modalBilang').value) || 0;
        document.getElementById('modalKabuuan').value = (presyo * bilang).toFixed(2);
    }

    document.getElementById('modalPresyo').addEventListener('input', computeModalTotal);
    document.getElementById('modalBilang').addEventListener('input', computeModalTotal);

    // ── Row index (starts after existing DB rows) ────────────────────────
    let rowIndex = "{{ $startup_items->count() }}";

    // ── Re-index all hidden inputs after removal ─────────────────────────
    function reIndexItems() {
        let idx = 0;
        document.querySelectorAll('#supplyBody tr.data-row').forEach(row => {
            row.querySelectorAll('input[type="hidden"]').forEach(input => {
                input.name = input.name.replace(/items\[\d+\]/, `items[${idx}]`);
            });
            idx++;
        });
        rowIndex = idx;
    }

    // ── Add Item ─────────────────────────────────────────────────────────
    document.getElementById('confirmAddBtn').addEventListener('click', function () {
        const errorBox  = document.getElementById('addItemError');
        const kategorya = document.getElementById('modalKategorya').value;
        const supplier  = document.getElementById('modalSupplier').value.trim();
        const item      = document.getElementById('modalItem').value.trim();
        const presyo    = parseFloat(document.getElementById('modalPresyo').value) || 0;
        const bilang    = parseFloat(document.getElementById('modalBilang').value) || 0;
        const kabuuan   = parseFloat(document.getElementById('modalKabuuan').value) || 0;

        if (!kategorya || !supplier || !item) {
            errorBox.classList.remove('d-none');
            return;
        }
        errorBox.classList.add('d-none');

        const row = document.createElement('tr');
        row.classList.add('data-row');
        row.dataset.category = kategorya;
        row.innerHTML = `
            <td>
                ${escHtml(supplier)}
                <input type="hidden" name="items[${rowIndex}][category]"      value="${escHtml(kategorya)}">
                <input type="hidden" name="items[${rowIndex}][supplier_name]" value="${escHtml(supplier)}">
                <input type="hidden" name="items[${rowIndex}][item_name]"     value="${escHtml(item)}">
                <input type="hidden" name="items[${rowIndex}][item_price]"    value="${presyo}">
                <input type="hidden" name="items[${rowIndex}][item_qty]"      value="${bilang}">
                <input type="hidden" name="items[${rowIndex}][item_total]"    value="${kabuuan}">
            </td>
            <td>${escHtml(item)}</td>
            <td style="text-align:right;">${presyo.toFixed(2)}</td>
            <td style="text-align:center;">${bilang}</td>
            <td class="row-kabuuan" data-value="${kabuuan}" style="text-align:right;">${kabuuan.toFixed(2)}</td>
            <td style="text-align:center;">
                <button type="button" class="btn btn-sm btn-danger remove-btn">×</button>
            </td>
        `;

        const totalRow        = document.getElementById('totalRow');
        const kagamitanCat    = document.getElementById('kagamitanCategory');

        if (kategorya === 'produkto') {
            totalRow.parentNode.insertBefore(row, kagamitanCat);
        } else {
            totalRow.parentNode.insertBefore(row, totalRow);
        }

        rowIndex++;
        markModified();
        computeGrandTotal();
        clearModal();

        bootstrap.Modal.getInstance(document.getElementById('addItemModal')).hide();
    });

    // ── Remove Row ───────────────────────────────────────────────────────
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-btn')) {
            e.target.closest('tr').remove();
            markModified();
            reIndexItems();
            computeGrandTotal();
        }
    });

    // ── AJAX Submit ──────────────────────────────────────────────────────
    document.getElementById('confirmSubmitBtn').addEventListener('click', function () {
        const modal     = bootstrap.Modal.getInstance(document.getElementById('confirmationModal'));
        const form      = document.getElementById('elporB1Form');
        const formData  = new FormData(form);
        const submitBtn = document.getElementById('confirmSubmitBtn');
        const updateBtn = document.getElementById('updateBtn');

        submitBtn.disabled = true;
        updateBtn.disabled = true;
        submitBtn.innerHTML = `
            <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
            Updating...
        `;

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: formData,
        })
        .then(res => res.json())
        .then(data => {
            modal.hide();
            showToast(
                data.message ?? (data.success ? 'Request updated successfully.' : 'Something went wrong.'),
                data.success ? 'success' : 'danger'
            );
            if (data.success) {
                itemsModified.value = '0';
            }
        })
        .catch(() => {
            modal.hide();
            showToast('A network error occurred. Please try again.', 'danger');
        })
        .finally(() => {
            submitBtn.disabled = false;
            updateBtn.disabled = false;
            submitBtn.innerHTML = 'Yes, Update';
        });
    });

    // ── Helpers ──────────────────────────────────────────────────────────
    function markModified() {
        itemsModified.value = '1';
    }

    function clearModal() {
        document.getElementById('modalKategorya').value = '';
        document.getElementById('modalSupplier').value  = '';
        document.getElementById('modalItem').value      = '';
        document.getElementById('modalPresyo').value    = '';
        document.getElementById('modalBilang').value    = '';
        document.getElementById('modalKabuuan').value   = '';
    }

    function escHtml(str) {
        const d = document.createElement('div');
        d.appendChild(document.createTextNode(String(str)));
        return d.innerHTML;
    }
});

// ── Validate & open confirm modal ────────────────────────────────────────
function validateAndSubmit() {
    const errors = [];
    const trim   = name => (document.querySelector(`[name="${name}"]`)?.value ?? '').trim();



    if (errors.length > 0) {
        document.getElementById('validationErrorList').innerHTML =
            errors.map(e => `<li class="mb-1">${e}</li>`).join('');
        new bootstrap.Modal(document.getElementById('validationModal')).show();
        return;
    }

    new bootstrap.Modal(document.getElementById('confirmationModal')).show();
}

// ── Toast ─────────────────────────────────────────────────────────────────
function showToast(message, type = 'success') {
    const toastEl  = document.getElementById('resultToast');
    const toastMsg = document.getElementById('toastMessage');
    toastEl.classList.remove('bg-success', 'bg-danger', 'bg-warning');
    toastEl.classList.add('bg-' + type);
    toastMsg.textContent = message;
    new bootstrap.Toast(toastEl, { delay: 4000 }).show();
}
</script>

@endsection