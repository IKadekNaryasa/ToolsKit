@props(['inventories','categories'])
<div class="card mb-4">
    <h5 class="card-header text-center">Data of Inventory</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-striped" id="inventoryTable">
                <thead>
                    <tr>
                        <th style="font-size: small;">No</th>
                        <th style="font-size: small;">Category</th>
                        <th style="font-size: small;" class="col-md-2">Date</th>
                        <th style="font-size: small;" class="text-center">Qty</th>
                        <th style="font-size: small;" class="col-md-2">Vendor</th>
                        <th style="font-size: small;">Notes</th>
                        <th style="font-size: small;" class="col-md-2">Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inventories as $inventory)
                    <tr>
                        <td style="font-size: small;">{{ $loop->iteration  }}</td>
                        <td style="font-size: small;">{{ $inventory->category->name }}</td>
                        <td style="font-size: small;">{{ $inventory->date }}</td>
                        <td style="font-size: small;" class="text-center">{{ $inventory->quantity }}</td>
                        <td style="font-size: small;">{{ $inventory->vendor }}</td>
                        <td style="font-size: small;">{{ $inventory->notes }}</td>
                        <td style="font-size: small;">Rp. {{ number_format($inventory->price,0,',','.') }}</td>
                        <td class="justify-content-center">
                            <i class="bx bx-edit bx-sm text-warning " type="button" data-bs-toggle="modal"
                                data-bs-target="#updateInventoryModal-{{ $inventory->id }}"></i>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No Inventory Found!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- modal -->
@foreach ($inventories as $inventory)
<div class="modal fade" id="updateInventoryModal-{{ $inventory->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Update Inventory</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.inventory.update',['inventory' => $inventory->id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="category" class="form-label">Category</label>
                            <select name="category" id="category" class="form-control mb-3" required>
                                <option selected value="{{ $inventory->category_id }}">{{ $inventory->category->name }}</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div id="categoryHelp" class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="date" class="form-label">Date</label>
                            <input class="form-control" type="date" name="date" required value="{{ old('date') ? old('date') : $inventory->date }}">
                            @error('date')
                            <div id="dateHelp" class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="qty" class="form-label">Qty</label>
                            <input class="form-control" type="number" name="qty" placeholder="input qty" required value="{{ old('qty') ? old('qty') : $inventory->quantity }}">
                            @error('quantity')
                            <div id="qtyHelp" class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="col-md-6">
                            <label for="vendor" class="form-label">Vendor</label>
                            <input class="form-control" type="text" name="vendor" placeholder="input vendor" required value="{{ old('vendor') ? old('vendor') : $inventory->vendor }}">
                            @error('vendor')
                            <div id="vendorHelp" class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="notes" class="form-label">Notes</label>
                            <input class="form-control" type="text" name="notes" placeholder="type notes" required value="{{ old('notes') ? old('notes') : $inventory->notes }}">
                            @error('notes')
                            <div id="notesHelp" class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="price" class="form-label">Price</label>
                            <input class="form-control" type="number" name="price" placeholder="type price" required value="{{ old('price') ? old('price') : $inventory->price }}">
                            @error('price')
                            <div id="priceHelp" class="form-text text-danger">
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
@if (session('errorFrom') == 'update')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var myModal = new bootstrap.Modal(document.getElementById("updateInventoryModal-{{ old('id') }}"));
        myModal.show();
    });
</script>
@endif
<script>
    $(document).ready(function() {
        $('#inventoryTable').DataTable();
    });
</script>
@endpush