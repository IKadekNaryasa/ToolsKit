<x-layout :active="$active" :open="$open" :link="$link">
    <div class="row text-end mb-1">
        <div class="col-">
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                data-bs-target="#insertUserModal"><i class="bx bx-plus bx-xs"></i></button>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <x-admin.user.user-data :users="$users"></x-admin.user.user-data>
        </div>
    </div>

    <div class="modal fade" id="insertUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Add New User</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.user.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="name">Name</label>
                                </div>
                                <div class="input-group">
                                    <input type="text" id="name" required class="form-control @error('name') invalid
                                    @enderror" value="{{ old('name') }}" name="name" style="text-transform:capitalize;" autofocus placeholder="type name" />
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
                                    @enderror" value="{{ old('username') }}" name="username" placeholder="type username" />
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
                                    @enderror" value="{{ old('contact') }}" name="contact" style="text-transform:capitalize;" placeholder="type contact" />
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
                                    <option selected disabled>Choose Role...</option>
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
    @if (session('errorFrom') === 'store')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById("insertUserModal"));
            myModal.show();
        });
    </script>
    @endif
</x-layout>