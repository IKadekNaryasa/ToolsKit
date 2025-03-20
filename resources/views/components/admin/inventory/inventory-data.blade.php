@props(['inventories'])
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
                        <th style="font-size: small;">Qty</th>
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
                        <td style="font-size: small;">{{ $inventory->quantity }}</td>
                        <td style="font-size: small;">{{ $inventory->vendor }}</td>
                        <td style="font-size: small;">{{ $inventory->notes }}</td>
                        <td style="font-size: small;">Rp. {{ number_format($inventory->total,0,',','.') }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning">edit</button>
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
@push('script')
<script>
    $(document).ready(function() {
        $('#inventoryTable').DataTable();
    });
</script>
@endpush