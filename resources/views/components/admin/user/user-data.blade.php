@props(['users'])
<div class="card mb-4">
    <h5 class="card-header text-center">Data of User</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-striped" id="userTable">
                <thead>
                    <tr>
                        <th style="font-size: small;">No</th>
                        <th style="font-size: small;">Name</th>
                        <th style="font-size: small;">Username</th>
                        <th style="font-size: small;">Contact</th>
                        <th style="font-size: small;" class="text-center">Status</th>
                        <th style="font-size: small;" class="text-center">Role</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td style="font-size: small;">{{ $loop->iteration  }}</td>
                        <td style="font-size: small;">{{ $user->name  }}</td>
                        <td style="font-size: small;">{{ $user->username  }}</td>
                        <td style="font-size: small;">{{ $user->contact  }}</td>
                        <td style="font-size: small;" class="text-center">{{ $user->status  }}</td>
                        <td style="font-size: small;" class="text-center">{{ $user->role  }}</td>
                        <td class="d-flex justify-content-center">
                            <form action="admin/aa" method="post" id="userDeleteForm">
                                @csrf
                                <input type="hidden" name="userId" value="{{ $user->id }}">
                                <i class="bx bx-edit text-warning mx-1" type="button"></i>
                                <i class="bx bx-trash text-danger mx-1" type="button" onclick="confirmUserDelete(event)"></i>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">No User Found!</td>
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
        $('#userTable').DataTable();
    });

    function confirmUserDelete(event) {
        event.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('userDeleteForm').submit();
            }
        });
    }
</script>
@endpush