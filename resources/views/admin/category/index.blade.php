<x-layout :active="$active" :open="$open" :link="$link">
    <!-- content here -->
    <!-- Basic Badges -->
    <div class="row text-end mb-1">
        <div class="col-">
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                data-bs-target="#insertCategoryModal"><i class="bx bx-plus bx-xs"></i></button>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-12">
            <x-admin.category.category-data class="category catgory-data" :categories="$categories"></x-admin.category.category-data>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="insertCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Add New Category</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.category.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="name">Category Name</label>
                                </div>
                                <div class="input-group">
                                    <input type="text" id="name" class="form-control @error('name') invalid
                                    @enderror" value="{{ old('name') }}" name="name" style="text-transform:capitalize;" autofocus placeholder="type category name" />
                                </div>
                                @error('name')
                                <div id="nameHelp" class="form-text text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @error('name')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById("insertCategoryModal"));
            myModal.show();
        });
    </script>
    @enderror
</x-layout>