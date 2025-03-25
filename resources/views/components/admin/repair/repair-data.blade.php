@props(['repairs'])
<div class="card mb-4">
    <h5 class="card-header text-center">Data of Reapir</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-striped" id="repairTable">
                <thead>
                    <tr>
                        <th style="font-size: small;">No</th>
                        <th style="font-size: small;">Tool Code</th>
                        <th style="font-size: small;" class="col-md-2">Maintenance Date</th>
                        <th style="font-size: small;" class="col-md-2">Finished Date</th>
                        <th style="font-size: small;">Notes</th>
                        <th style="font-size: small;" class="col-md-2 text-center">Status</th>
                        <th style="font-size: small;">Cost</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($repairs as $repair)
                    <tr>
                        <td style="font-size: small;">{{ $loop->iteration  }}</td>
                        <td style="font-size: small;">{{ $repair->tool->tool_code }}</td>
                        <td style="font-size: small;">{{ $repair->repair_date }}</td>
                        <td style="font-size: small;">{{ $repair->completion_date }}</td>
                        <td style="font-size: small;">{{ $repair->description }}</td>
                        <td style="font-size: small;" class="text-center">{{ $repair->status }}</td>
                        <td style="font-size: small;">Rp. {{ number_format($repair->cost,0,',','.') }}</td>
                        <td class="text-center">
                            @if ($repair->status == 'in_progress')
                            <i class="bx bx-time-five" type="button"></i>
                            @elseif($repair->status == 'done')
                            <i class="bx bx-check"></i>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No Tool on repair Found!</td>
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
        $('#repairTable').DataTable();
    });
</script>
@endpush