@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&display=swap');

    .sr-wrapper {
        font-family: 'DM Sans', sans-serif;
        padding: 2rem 2.5rem;
        background: #f4f6f9;
        min-height: 100vh;
    }

    .sr-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
        overflow: hidden;
    }

    .sr-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.5rem 1.75rem 1rem;
    }

    .sr-header h4 {
        font-size: 1.2rem;
        font-weight: 600;
        color: #1a1a2e;
        margin: 0;
        letter-spacing: -0.01em;
    }

    /* Search */
    .sr-search-wrap {
        position: relative;
        display: flex;
        align-items: center;
    }

    .sr-search-wrap input {
        border: 1.5px solid #e2e6ea;
        border-radius: 8px;
        padding: 0.45rem 2.4rem 0.45rem 0.85rem;
        font-size: 0.85rem;
        font-family: 'DM Sans', sans-serif;
        color: #333;
        width: 220px;
        outline: none;
        transition: border-color 0.2s;
        background: #fafbfc;
    }

    .sr-search-wrap input:focus {
        border-color: #a0aec0;
        background: #fff;
    }

    .sr-search-wrap .search-icon {
        position: absolute;
        right: 0.7rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9aa5b4;
        font-size: 0.9rem;
        pointer-events: none;
        transition: opacity 0.2s;
    }

    /* Spinner */
    .sr-spinner {
        display: none;
        position: absolute;
        right: 0.65rem;
        top: 50%;
        transform: translateY(-50%);
        width: 14px;
        height: 14px;
        border: 2px solid #e2e6ea;
        border-top-color: #f59e0b;
        border-radius: 50%;
        animation: spin 0.6s linear infinite;
    }

    .sr-spinner.active {
        display: block;
    }

    .sr-spinner.active + .search-icon {
        opacity: 0;
    }

    @keyframes spin {
        to { transform: translateY(-50%) rotate(360deg); }
    }

    /* Table */
    .sr-table {
        width: 100%;
        border-collapse: collapse;
    }

    .sr-table thead tr {
        background: #f8f9fb;
        border-bottom: 1.5px solid #eef0f3;
    }

    .sr-table thead th {
        padding: 0.85rem 1.2rem;
        font-size: 0.8rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        white-space: nowrap;
        user-select: none;
    }

    .sr-table thead th .sort-icon {
        display: inline-block;
        margin-left: 4px;
        color: #b0b8c4;
        font-size: 0.75rem;
        vertical-align: middle;
    }

    .sr-table tbody tr {
        border-bottom: 1px solid #f0f2f5;
        transition: background 0.15s;
    }

    .sr-table tbody tr:last-child {
        border-bottom: none;
    }

    .sr-table tbody tr:nth-child(odd) {
        background: #ffffff;
    }

    .sr-table tbody tr:nth-child(even) {
        background: #f7f9fc;
    }

    .sr-table tbody td {
        padding: 0.9rem 1.2rem;
        font-size: 0.875rem;
        color: #374151;
        vertical-align: middle;
    }

    .sr-table tbody td:first-child {
        font-weight: 600;
        color: #1a1a2e;
        width: 80px;
    }

    /* Status Badges */
    .badge-status {
        display: inline-block;
        padding: 0.3rem 0.85rem;
        border-radius: 6px;
        font-size: 0.78rem;
        font-weight: 600;
        letter-spacing: 0.01em;
        white-space: nowrap;
    }

    .badge-new-submission {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffc10733;
    }

    .badge-forms-requested {
        background: #cfe2ff;
        color: #084298;
        border: 1px solid #0d6efd33;
    }

    .badge-submitted-for-review {
        background: #d1e7dd;
        color: #0f5132;
        border: 1px solid #19875433;
    }

    .badge-approved {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #10b98133;
    }

    .badge-declined {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #ef444433;
    }

    /* View Button */
    .btn-view {
        display: inline-block;
        padding: 0.35rem 1rem;
        background: #f59e0b;
        color: #fff;
        font-size: 0.8rem;
        font-weight: 600;
        border-radius: 7px;
        text-decoration: none;
        transition: background 0.2s, transform 0.1s;
        border: none;
        cursor: pointer;
        letter-spacing: 0.01em;
        font-family: 'DM Sans', sans-serif;
    }

    .btn-view:hover {
        background: #d97706;
        color: #fff;
        transform: translateY(-1px);
        text-decoration: none;
    }

    .btn-view:active {
        transform: translateY(0);
    }

    /* Empty state */
    .sr-empty {
        text-align: center;
        padding: 3rem 1rem;
        color: #9aa5b4;
        font-size: 0.9rem;
    }

    /* Fade animation for rows */
    @keyframes fadeInRow {
        from { opacity: 0; transform: translateY(4px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .sr-table tbody tr {
        animation: fadeInRow 0.18s ease both;
    }
</style>

<div class="sr-wrapper">
    <div class="sr-card">
        <div class="sr-header">
            <h4>Submitted Requests</h4>
            <div class="sr-search-wrap">
                <input type="text" placeholder="Search..." id="srSearch" autocomplete="off" />
                <div class="sr-spinner" id="srSpinner"></div>
                <span class="search-icon">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                </span>
            </div>
        </div>

        <table class="sr-table" id="srTable">
            <thead>
                <tr>
                    <th>Request No.</th>
                    <th>OFW Name</th>
                    <th>Party Name</th>
                    <th>
                        Status
                        <span class="sort-icon">&#9658;</span>
                    </th>
                    <th>
                        Date Submitted
                        <span class="sort-icon">&#9658;</span>
                    </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="srTableBody">
                @forelse($requests as $request)
                    <tr>
                        <td>{{ $request->id }}</td>
                        <td>
                            {{ optional($request->requestOfw)->ofw_fname }}
                            {{ optional($request->requestOfw)->ofw_mname }}
                            {{ optional($request->requestOfw)->ofw_lname }}
                            {{ optional($request->requestOfw)->ofw_ename }}
                        </td>
                        <td>
                            {{ optional($request->requestParty)->party_fname ?? '-' }}
                            {{ optional($request->requestParty)->party_mname }}
                            {{ optional($request->requestParty)->party_lname ?? '-' }}
                            {{ optional($request->requestParty)->party_ename }}
                        </td>
                        <td>
                            @php
                                $status = strtoupper($request->status);
                                $badgeClass = match($status) {
                                    'NEW_SUBMISSION'    => 'badge-new-submission',
                                    'FORMS_REQUESTED' => 'badge-forms-requested',
                                    'SUBMITTED_FOR_REVIEW'   => 'badge-submitted-for-review',
                                    'APPROVED'   => 'badge-approved',
                                    'REJECTED'   => 'badge-declined',
                                    default      => 'badge-new-submission',
                                };
                            @endphp
                            <span class="badge-status {{ $badgeClass }}">
                                {{ str_replace('_', ' ', ucfirst(strtolower($request->status))) }}
                            </span>
                        </td>
                        <td>{{ $request->created_at->format('M d, Y | h:i A') }}</td>
                        <td>
                            <a href="{{ route('forms-submitted.show', $request->id) }}" class="btn-view">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="sr-empty">No submitted requests found.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    const searchInput = document.getElementById('srSearch');
    const tableBody   = document.getElementById('srTableBody');
    const spinner     = document.getElementById('srSpinner');
    const searchUrl   = "{{ route('forms-submitted.search') }}";
    const showUrl = "{{ route('forms-submitted.show', ['id' => '__ID__']) }}";

    let debounceTimer = null;

    function badgeClass(status) {
        const map = {
            'NEW_SUBMISSION':    'badge-new-submission',
            'FORMS_REQUESTED': 'badge-forms-requested',
            'SUBMITTED_FOR_REVIEW':   'badge-submitted-for-review',
            'APPROVED':   'badge-approved',
            'REJECTED':   'badge-declined',
        };
        return map[(status ?? '').toUpperCase()] ?? 'badge-new-submission';
    }

    function formatStatus(str) {
        if (!str) return '';
        return str.replace(/_/g, ' ').split(' ').map(word => 
            word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()
        ).join(' ');
    }

    function ucfirst(str) {
        if (!str) return '';
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    function fullName(obj, prefix) {
        if (!obj) return '—';
        return [obj[`fname`], obj[`mname`], obj[`lname`], obj[`ename`]]
            .filter(Boolean).join(' ') || '—';
    }

    function formatDate(dateStr) {
        if (!dateStr) return '—';
        const d = new Date(dateStr);
        const opts = { month: 'short', day: '2-digit', year: 'numeric',
                       hour: '2-digit', minute: '2-digit', hour12: true };
        return d.toLocaleString('en-US', opts);
    }

    function renderRows(data) {
        if (!data.length) {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="6">
                        <div class="sr-empty">No submitted requests found.</div>
                    </td>
                </tr>`;
            return;
        }

        tableBody.innerHTML = data.map((req, i) => {
            const ofwName   = fullName(req.ofw);
            const partyName = fullName(req.party);
            const status    = req.status ?? 'pending';
            const rowBg     = i % 2 === 0 ? '#ffffff' : '#f7f9fc';

            return `
                <tr style="background:${rowBg}; animation-delay:${i * 0.03}s">
                    <td>${req.id}</td>
                    <td>${ofwName}</td>
                    <td>${partyName}</td>
                    <td>
                        <span class="badge-status ${badgeClass(status)}">
                            ${formatStatus(status)}
                        </span>
                    </td>
                    <td>${formatDate(req.created_at)}</td>
                    <td>
                        <a href="${showUrl.replace('__ID__', req.id)}" class="btn-view">View</a>
                    </td>
                </tr>`;
        }).join('');
    }

    function doSearch(query) {
        spinner.classList.add('active');

        fetch(`${searchUrl}?q=${encodeURIComponent(query)}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? ''
            }
        })
        .then(res => {
            // Show raw text first if not OK, helps debugging
            if (!res.ok) {
                return res.text().then(text => {
                    console.error('Server error:', text);
                    throw new Error(`HTTP ${res.status}`);
                });
            }
            return res.json();
        })
        .then(data => {
            renderRows(data);
        })
        .catch(err => {
            console.error('Search failed:', err);
            tableBody.innerHTML = `
                <tr>
                    <td colspan="6">
                        <div class="sr-empty">Something went wrong. Please try again.</div>
                    </td>
                </tr>`;
        })
        .finally(() => {
            spinner.classList.remove('active');
        });
    }

    searchInput.addEventListener('input', function () {
        clearTimeout(debounceTimer);
        const query = this.value.trim();
        debounceTimer = setTimeout(() => doSearch(query), 350);
    });
</script>

@endsection