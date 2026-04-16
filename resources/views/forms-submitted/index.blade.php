@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h4 class="mb-3">Submitted Requests</h4>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Request #</th>
                <th>OFW Name</th>
                <th>Party Name</th>
                <th>Status</th>
                <th>Date Submitted</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
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
                        {{ optional($request->requestParty)->party_fname }}
                        {{ optional($request->requestParty)->party_mname }}
                        {{ optional($request->requestParty)->party_lname }}
                        {{ optional($request->requestParty)->party_ename }}
                    </td>

                    <td>
                        <span class="badge bg-warning">
                            {{ $request->status }}
                        </span>
                    </td>

                    <td>
                        {{ $request->created_at->format('M d, Y h:i A') }}
                    </td>

                    <td class="text-center">
                        <a href="{{ route('forms-submitted.show', $request->id) }}"
                            class="btn btn-sm btn-primary">
                            View
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">
                        No submitted requests found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection