@props(['requests'])
<div class="card mb-4">
    <h5 class="card-header text-center">Data of Tool Request</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-striped" id="requestTable">
                <thead>
                    <tr>
                        <th style="font-size: small;">No</th>
                        <th style="font-size: small;">Request Code</th>
                        <th style="font-size: small;">User</th>
                        <th style="font-size: small;">Status</th>
                        <th style="font-size: small;">Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $request)
                    <tr>
                        <td style="font-size: small;">{{ $loop->iteration  }}</td>
                        <td style="font-size: small;">{{ $request->request_code  }}</td>
                        <td style="font-size: small;">{{ $request->user->name  }}</td>
                        <td style="font-size: small;">{{ $request->user->status  }}</td>
                        <td style="font-size: small;">{{ $request->user->date  }}</td>
                        <td class="d-flex justify-content-center">
                            <button class="btn btn-sm btn-warning mx-1">Edit</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                            <button class="btn btn-sm btn-secondary mx-1">Print</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No Request Found!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('script')
<script>
    $(document).ready(function() {
        $('#requestTable').DataTable();
    });
</script>
@endpush