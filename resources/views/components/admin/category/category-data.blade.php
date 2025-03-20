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
                        <th>Quantity</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration  }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->quantity }}</td>
                        <td>{{ $category->created_at->diffForHumans() }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning">edit</button>
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
@push('script')
<script>
    $(document).ready(function() {
        $('#categoryTable').DataTable();
    });
</script>
@endpush