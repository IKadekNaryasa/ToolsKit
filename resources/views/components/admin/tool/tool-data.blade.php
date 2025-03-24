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
                        <th style="font-size: small;" class="text-center">Condition</th>
                        <th style="font-size: small;" class="text-center">Status</th>
                        <th style="font-size: small;">Category</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tools as $tool)
                    <tr>
                        <td style="font-size: small;">{{ $loop->iteration  }}</td>
                        <td style="font-size: small;">{{ $tool->tool_code  }}</td>
                        <td style="font-size: small;">{{ $tool->name  }}</td>
                        <td style="font-size: small;" class="text-center">{{ $tool->condition  }}</td>
                        <td style="font-size: small;" class="text-center">{{ $tool->status  }}</td>
                        <td style="font-size: small;">{{ $tool->category->name  }}</td>
                        <td class="d-flex justify-content-center">
                            <i class="bx bx-edit bx-xs mx-1  text-warning" type="button"></i>
                            <i class="bx bx-printer bx-xs mx-1  text-secondary" type="button"></i>
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
    })
</script>
@endpush