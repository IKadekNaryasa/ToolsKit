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
                        <td style="font-size: small;" class="text-center">
                            @if ($user->status === 'active')
                            <span class="badge bg-success" style="text-transform: capitalize;">Active</span>
                            @elseif($user->status === 'suspend')
                            <span class="badge bg-danger" style="text-transform: capitalize;">Supended</span>
                            @endif
                        </td>
                        <td style="font-size: small;" class="text-center">
                            @if ($user->role === 'admin')
                            <span class="badge bg-primary" style="text-transform: capitalize;">
                                Admin
                            </span>
                            @if (auth()->user()->id === $user->id)
                            <span class="badge bg-success rounded-pill badge-xs">a</span>
                            @endif
                            @elseif($user->role === 'head')
                            <span class="badge bg-secondary" style="text-transform: capitalize;">Head</span>
                            @elseif($user->role === 'technician')
                            <span class="badge bg-info" style="text-transform: capitalize;">Technician</span>
                            @endif
                        </td>
                        <td class="d-flex justify-content-center">
                            <i class="bx bx-edit text-warning mx-1" type="button" data-bs-toggle="modal" data-bs-target="#updateUserModal-{{ $user->id }}"></i>
                            <form action="{{route('admin.user.destroy',['user' => $user->id])}}" method="post" id="userDeleteForm-{{ $user->id }}">
                                @csrf
                                @method('DELETE')
                                <i class="bx bx-trash text-danger mx-1" type="button" onclick="confirmUserDelete(event)" data-id="{{ $user->id }}" data-user="{{ $user->name }}"></i>
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
@foreach ($users as $user)
<div class="modal fade" id="updateUserModal-{{ $user->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Update User Data</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.user.update',['user' => $user->id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="name">Name</label>
                            </div>
                            <div class="input-group">
                                <input type="text" id="name" required class="form-control @error('name') invalid
                                    @enderror" value="{{ old('name', $user->name) }}" name="name" style="text-transform:capitalize;" autofocus placeholder="type name" />
                            </div>
                            @error('name')
                            <div id="nameHelp" class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="username">Username</label>
                            </div>
                            <div class="input-group">
                                <input type="text" id="username" required class="form-control @error('username') invalid
                                    @enderror" value="{{ old('username', $user->username) }}" name="username" placeholder="type username" />
                            </div>
                            @error('username')
                            <div id="usernameHelp" class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="contact">Contact</label>
                            </div>
                            <div class="input-group">
                                <input type="number" id="contact" required class="form-control @error('contact') invalid
                                    @enderror" value="{{ old('contact', $user->contact) }}" name="contact" style="text-transform:capitalize;" placeholder="type contact" />
                            </div>
                            @error('contact')
                            <div id="contactHelp" class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="contact">Role</label>
                            </div>
                            <select name="role" id="role" required class="form-select">
                                <option selected value="{{ $user->role }}">{{$user->role}}</option>
                                <option value="head">Head</option>
                                <option value="admin">Admin</option>
                                <option value="technician">Technician</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endforeach
@push('script')
@if (session('errorFrom') === 'update')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var myModal = new bootstrap.Modal(document.getElementById("updateUserModal-{{ session('userId') }}"));
        myModal.show();
    });
</script>
@endif
<script>
    $(document).ready(function() {
        $('#userTable').DataTable();
    });

    function confirmUserDelete(event) {
        event.preventDefault();
        const userId = event.target.getAttribute('data-id');
        const userName = event.target.getAttribute('data-user');
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to delete " + userName,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('userDeleteForm-' + userId).submit();
            }
        });
    }
</script>
@endpush