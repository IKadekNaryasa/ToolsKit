@props(['tools','categories'])
<div class="card mb-4">
    <h5 class="card-header text-center">Data of Tool</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-striped" id="toolTable">
                <thead>
                    <tr>
                        <th style="font-size: small;">No</th>
                        <th style="font-size: small;">Tool Code</th>
                        <th style="font-size: small;">Name</th>
                        <th style="font-size: small;" class="text-center">Condition</th>
                        <th style="font-size: small;" class="text-center">Status</th>
                        <th style="font-size: small;">Category</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tools as $tool)
                    <tr>
                        <td style="font-size: small;">{{ $loop->iteration  }}</td>
                        <td style="font-size: small;">{{ $tool->tool_code  }}</td>
                        <td style="font-size: small;">{{ $tool->name  }}</td>
                        <td style="font-size: small;" class="text-center">{{ $tool->condition  }}</td>
                        <td style="font-size: small;" class="text-center">
                            @if ($tool->status === 'available')
                            <i class="badge bg-success" style="text-transform: capitalize;">Available</i>
                            @elseif($tool->status === 'repair')
                            <i class="badge bg-primary" style="text-transform: capitalize;">In Repair</i>
                            @elseif($tool->status === 'maintenance')
                            <i class="badge bg-warning" style="text-transform: capitalize;">In Mainteance</i>
                            @elseif($tool->status === 'damaged')
                            <i class="badge bg-danger" style="text-transform: capitalize;">Damaged</i>
                            @elseif($tool->status === 'borrowed')
                            <i class="badge bg-info" style="text-transform: capitalize;">Borrowed</i>
                            @endif
                        </td>
                        <td style="font-size: small;">{{ $tool->category->name  }}</td>
                        <td class="d-flex justify-content-center">
                            @if ($tool->status === 'available')
                            <i class="bx bx-edit bx-xs mx-1  text-warning" type="button" data-bs-toggle="modal" data-bs-target="#editToolModal-{{ $tool->tool_code }}"></i>
                            @elseif($tool->status !== 'available')
                            <i class="bx bx-edit bx-xs mx-1 text-secondary" type="button"></i>
                            @endif
                            <i class="bx bx-printer bx-xs mx-1  text-secondary" type="button"></i>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No Tools Found!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($tools as $tool)
<!-- modal -->
<div class="modal fade" id="editToolModal-{{ $tool->tool_code }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Update Tool : {{ $tool->tool_code }}</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.tool.update',['tool'=>$tool->tool_code]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="name">Category</label>
                            </div>
                            <select name="category_id" required id="" class="form-control">
                                <option selected value="{{ $tool->category_id }}">{{ $tool->category->name }}</option>
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
                            <input type="text" class="form-control" name="name" required value="{{ old('name') ? old('name') : $tool->name }}" placeholder="type tool name" style="text-transform: capitalize;">
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
                            <input type="text" class="form-control" name="condition" required value="{{ old('condition') ? old('condition') : $tool->condition }}" placeholder="type tool condition" style="text-transform: capitalize;">
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
                                <option selected value="{{ $tool->status }}">{{$tool->status}}</option>
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
@endforeach


@push('script')
@if (session('toolType') === 'update')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var myModal = new bootstrap.Modal(document.getElementById("editToolModal-{{ $tool->tool_code }}"));
        myModal.show();

    });
</script>
@endif
<script>
    $(document).ready(function() {
        $('#toolTable').DataTable();
    })
</script>
@endpush