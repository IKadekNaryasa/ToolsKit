@props(['borrowings'])
<div class="card mb-4">
    <h5 class="card-header text-center">Data of Borrowing</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-striped" id="borrowingTable">
                <thead>
                    <tr>
                        <th style="font-size: small;">No</th>
                        <th style="font-size: small;">Borrowing Code</th>
                        <th style="font-size: small;">User</th>
                        <th style="font-size: small;">Borrow Date</th>
                        <th style="font-size: small;">Return Date</th>
                        <th style="font-size: small;">Notes</th>
                        <th style="font-size: small;">Status</th>
                        <th style="font-size: small;">By Admin</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrowings as $borrowed)
                    <tr>
                        <td>{{ $loop->iteration  }}</td>
                        <td style="font-size: small;">{{ $borrowed->borrowing_code }}</td>
                        <td style="font-size: small;">{{ $borrowed->user->name }}</td>
                        <td style="font-size: small;">{{ $borrowed->borrowing_date }}</td>
                        <td style="font-size: small;">{{ $borrowed->return_date }}</td>
                        <td style="font-size: small;">{{ $borrowed->notes }}</td>
                        <td style="font-size: small;">{{ $borrowed->status }}</td>
                        <td style="font-size: small;">{{ $borrowed->user->name }}</td>
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
        $('#borrowingTable').DataTable();
    });
</script>
@endpush