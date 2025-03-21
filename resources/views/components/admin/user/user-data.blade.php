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
                            <button class="btn btn-sm btn-warning mx-1">
                                <i class="fa-solid fa-pencil fa-sm"></i>
                            </button>
                            <button class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash fa-sm"></i>
                            </button>
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
</script>
@endpush