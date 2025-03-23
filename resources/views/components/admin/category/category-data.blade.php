@props(['categories'])
<div class="card mb-4">
    <h5 class="card-header text-center">Data of Category</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-striped" id="categoryTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Category Name</th>
                        <th class="text-center">Quantity</th>
                        <th>Created</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration  }}</td>
                        <td>{{ $category->name }}</td>
                        <td class="text-center">{{ $category->quantity }}</td>
                        <td>{{ $category->created_at->diffForHumans() }}</td>
                        <td class="text-center">
                            <i class="bx bx-edit bx-xs text-warning" type="button" data-bs-toggle="modal"
                                data-bs-target="#updateCategoryModal-{{ $category->id }}"></i>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No Category Found!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- modal -->
@foreach ($categories as $category)
<div class="modal fade" id="updateCategoryModal-{{ $category->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Update a Category</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.category.update',['category'=>$category->id])}}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="nameForUpdate">Category Name</label>
                            </div>
                            <div class="input-group">
                                <input type="text" id="nameForUpdate" class="form-control @error('nameForUpdate') invalid
                                     @enderror" value="{{ old('nameForUpdate') ? old('nameForUpdate') : $category->name }}" name="nameForUpdate" style="text-transform:capitalize;" autofocus placeholder="type category name" />
                            </div>
                            @error('nameForUpdate')
                            <div id="nameForUpdateHelp" class="form-text text-danger">
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
@endforeach
@push('script')

@error('nameForUpdate')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var myModal = new bootstrap.Modal(document.getElementById("updateCategoryModal-{{ $category->id }}"));
        myModal.show();
    });
</script>
@enderror

<script>
    $(document).ready(function() {
        $('#categoryTable').DataTable();
    });
</script>
@endpush