<x-layout :active="$active" :open="$open" :link="$link">
    <div class="row text-end mb-1">
        <div class="col-">
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                data-bs-target="#insertToolModal"><i class="bx bx-plus bx-xs"></i></button>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <x-admin.tool.tool-data :tools="$tools"></x-admin.tool.tool-data>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="insertToolModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Add New Tool</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.tool.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="name">Category</label>
                                </div>
                                <select name="category_id" required id="" class="form-control">
                                    <option selected disabled>Choose category...</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div id="categoryIdHelp" class="form-text text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="name">Tool Name</label>
                                </div>
                                <input type="text" class="form-control" name="name" required value="{{ old('name') }}" placeholder="type tool name" style="text-transform: capitalize;">
                                @error('name')
                                <div id="nameHelp" class="form-text text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="name">Tool Condition</label>
                                </div>
                                <input type="text" class="form-control" name="condition" required value="{{ old('condition') }}" placeholder="type tool condition" style="text-transform: capitalize;">
                                @error('condition')
                                <div id="conditionHelp" class="form-text text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="name">Status</label>
                                </div>
                                <select name="status" required id="" class="form-control">
                                    <option selected disabled>Choose status...</option>
                                    <option value="available">Available</option>
                                    <option value="repair">Repair</option>
                                    <option value="maintenance">Maintenance</option>
                                    <option value="damaged">Damaged</option>
                                    <option value="borrowed">Borrowed</option>
                                </select>
                                @error('status')
                                <div id="statusIdHelp" class="form-text text-danger">
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
    @if (session('toolType') === 'store')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById("insertToolModal"));
            myModal.show();
        });
    </script>
    @endif
</x-layout>