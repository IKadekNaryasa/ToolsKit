@props(['maintenances'])
<div class="card mb-4">
    <h5 class="card-header text-center">Data of Maintenance</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-striped" id="maintenanceTable">
                <thead>
                    <tr>
                        <th style="font-size: small;">No</th>
                        <th style="font-size: small;">Tool Code</th>
                        <th style="font-size: small;" class="col-md-2">Maintenance Date</th>
                        <th style="font-size: small;" class="col-md-2">Finished Date</th>
                        <th style="font-size: small;">Notes</th>
                        <th style="font-size: small;" class="col-md-2">Status</th>
                        <th style="font-size: small;">Cost</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($maintenances as $maintenance)
                    <tr>
                        <td style="font-size: small;">{{ $loop->iteration  }}</td>
                        <td style="font-size: small;">{{ $maintenance->tool->tool_code }}</td>
                        <td style="font-size: small;">{{ $maintenance->maintenance_date }}</td>
                        <td style="font-size: small;">{{ $maintenance->done_date }}</td>
                        <td style="font-size: small;">{{ $maintenance->description }}</td>
                        <td style="font-size: small;">{{ $maintenance->status }}</td>
                        <td style="font-size: small;">Rp. {{ number_format($maintenance->cost,0,',','.') }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning">edit</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No Tool on maintenance Found!</td>
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
        $('#maintenanceTable').DataTable();
    });
</script>
@endpush