@props(['tools'])
<div class="card mb-4">
    <h5 class="card-header text-center">Data of Tool</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-striped" id="toolTable">
                <thead>
                    <tr>
                        <th style="font-size: small;">No</th>
                        <th style="font-size: small;">Tool Code</th>
                        <th style="font-size: small;">Name</th>
                        <th style="font-size: small;">Condition</th>
                        <th style="font-size: small;">Status</th>
                        <th style="font-size: small;">Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tools as $tool)
                    <tr>
                        <td style="font-size: small;">{{ $loop->iteration  }}</td>
                        <td style="font-size: small;">{{ $tool->tool_code  }}</td>
                        <td style="font-size: small;">{{ $tool->name  }}</td>
                        <td style="font-size: small;">{{ $tool->condition  }}</td>
                        <td style="font-size: small;">{{ $tool->status  }}</td>
                        <td style="font-size: small;">{{ $tool->category->name  }}</td>
                        <td class="d-flex">
                            <button class="btn btn-sm btn-warning mx-1">Edit</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                            <button class="btn btn-sm btn-secondary mx-1">Print</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No Tools Found!</td>
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
        $('#toolTable').DataTable();
    });
</script>
@endpush