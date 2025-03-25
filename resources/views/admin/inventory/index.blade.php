<x-layout :active="$active" :open="$open" :link="$link">
    <div class="row text-end mb-1">
        <div class="col-">
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                data-bs-target="#insertInventoryModal"><i class="bx bx-plus bx-xs"></i></button>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <x-admin.inventory.inventory-data :inventories="$inventories" :categories="$categories"></x-admin.inventory.inventory-data>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="insertInventoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Add New Inventory</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.inventory.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="category" class="form-label">Category</label>
                                <select name="category" id="category" class="form-control " required>
                                    <option selected disabled>choose category ...</option>
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
                                <input class="form-control" type="date" name="date" required value="{{ old('date') }}">
                                @error('date')
                                <div id="dateHelp" class="form-text text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="qty" class="form-label">Qty</label>
                                <input class="form-control" type="number" name="qty" placeholder="input qty" required value="{{ old('qty') }}">
                                @error('quantity')
                                <div id="qtyHelp" class="form-text text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                            <div class="col-md-6">
                                <label for="vendor" class="form-label">Vendor</label>
                                <input class="form-control" type="text" name="vendor" placeholder="input vendor" required value="{{ old('vendor') }}">
                                @error('vendor')
                                <div id="vendorHelp" class="form-text text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="notes" class="form-label">Notes</label>
                                <input class="form-control" type="text" name="notes" placeholder="type notes" required value="{{ old('notes') }}">
                                @error('notes')
                                <div id="notesHelp" class="form-text text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="price" class="form-label">Price</label>
                                <input class="form-control" type="number" name="price" placeholder="type price" required value="{{ old('price') }}">
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
    @if (session('errorType') == 'store')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById("insertInventoryModal"));
            myModal.show();
        });
    </script>
    @endif
</x-layout>