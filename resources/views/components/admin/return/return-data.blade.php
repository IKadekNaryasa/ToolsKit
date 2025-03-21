@props(['returns'])
<div class="card mb-4">
    <h5 class="card-header text-center">Data of Return</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-striped" id="returnTable">
                <thead>
                    <tr>
                        <th style="font-size: small;">No</th>
                        <th style="font-size: small;">Borrowing Code</th>
                        <th style="font-size: small;">Return Date</th>
                        <th style="font-size: small;">Notes</th>
                        <th style="font-size: small;">Admin</th>
                        <th style="font-size: small;">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($returns as $return)
                    <tr>
                        <td>{{ $loop->iteration  }}</td>
                        <td style="font-size: small;">{{ $return->borrowing_code }}</td>
                        <td style="font-size: small;">{{ $return->return_date }}</td>
                        <td style="font-size: small;">{{ $return->notes }}</td>
                        <td style="font-size: small;">{{ $return->admin->name }}</td>
                        <td style="font-size: small;">{{ $return->status }}</td>
                        <td class="d-flex justify-content-center">
                            <button class="btn btn-sm btn-primary"
                                data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasStart{{ $return->id }}"
                                aria-controls="offcanvasStart">
                                <i class="fa-solid fa-circle-info fa-sm"></i>
                            </button>
                            <div
                                class="offcanvas offcanvas-start"
                                tabindex="-1"
                                id="offcanvasStart{{ $return->id }}"
                                aria-labelledby="offcanvasStartLabel">
                                <div class="offcanvas-header">
                                    <h5 id="offcanvasStartLabel" class="offcanvas-title text-center">Detail of {{ $return->borrowing->borrowing_code }}</h5>
                                    <button
                                        type="button"
                                        class="btn-close text-reset"
                                        data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body my-auto mx-auto border flex-grow-0">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tool Code</th>
                                                <th>Tool Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($return->borrowing->detail as $item )
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->tool->tool_code }}</td>
                                                <td>{{ $item->tool->name }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- <button type="button" class="btn btn-primary mb-2 d-grid w-100">Continue</button> -->
                                    <!-- <button
                                        type="button"
                                        class="btn btn-outline-secondary d-grid w-100"
                                      a data-bs-dismiss="offcanvas">
                                        Cancel
                                    </button> -->
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">No Transaction Found!</td>
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
        $('#returnTable').DataTable();
    });
</script>
@endpush