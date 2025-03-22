<div class="card mb-4">
    <h5 class="card-header">Profile</h5>
    <!-- Account -->
    <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
            <img
                src="{{asset('ikn_sneat')}}/assets/img/avatars/1.png"
                alt="user-avatar"
                class="d-block rounded"
                height="100"
                width="100"
                id="uploadedAvatar" />
            <div class="button-wrapper">
                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                    <span class="d-none d-sm-block">Upload new photo</span>
                    <i class="bx bx-upload d-block d-sm-none"></i>
                    <input
                        type="file"
                        id="upload"
                        name="foto"
                        class="account-file-input"
                        hidden
                        accept="image/png, image/jpeg" />
                </label>

                <p class="text-muted mb-0">Allowed JPG or PNG. Max size of 1MB</p>
            </div>
        </div>
    </div>
    <hr class="my-0" />
    <div class="card-body">
        <form id="formAccountSettings" action="{{ route('updateProfile') }}" method="post">
            @csrf
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{auth()->user()->name}}" autofocus />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="username" class="form-label">username</label>
                    <input class="form-control" type="text" id="username" name="username" value="{{auth()->user()->username}}" autofocus />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="contact" class="form-label">contact</label>
                    <input class="form-control" type="text" id="contact" name="contact" value="{{auth()->user()->contact}}" autofocus />
                </div>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Save changes</button>
            </div>
        </form>
    </div>
    <!-- /Account -->
</div>