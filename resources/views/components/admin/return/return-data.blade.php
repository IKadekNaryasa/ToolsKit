@props(['returns'])
<div class="card mb-4">
    <h5 class="card-header text-center">Data of Return</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-striped" id="returnTable">
                <thead>
                    <tr>
                        <th style="font-size: small;">No</th>
                        <th style="font-size: small;">Borrowing Code</th>
                        <th style="font-size: small;">Return Date</th>
                        <th style="font-size: small;">Notes</th>
                        <th style="font-size: small;">Admin</th>
                        <th style="font-size: small;">Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($returns as $return)
                    <tr>
                        <td>{{ $loop->iteration  }}</td>
                        <td style="font-size: small;">{{ $return->borrowing_code }}</td>
                        <td style="font-size: small;">{{ $return->return_date }}</td>
                        <td style="font-size: small;">{{ $return->notes }}</td>
                        <td style="font-size: small;">{{ $return->user->name }}</td>
                        <td style="font-size: small;">{{ $return->status }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning">edit</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">No Transaction Found!</td>
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
        $('#returnTable').DataTable();
    });
</script>
@endpush