@props(['borrowings'])
<div class="card mb-4">
    <h5 class="card-header text-center">Data of Borrowing</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-striped" id="borrowingTable">
                <thead>
                    <tr>
                        <th style="font-size: small;">No</th>
                        <th style="font-size: small;">Borrowing Code</th>
                        <th style="font-size: small;">User</th>
                        <th style="font-size: small;">Borrow Date</th>
                        <th style="font-size: small;">Return Date</th>
                        <th style="font-size: small;">Notes</th>
                        <th style="font-size: small;">Status</th>
                        <th style="font-size: small;">By Admin</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrowings as $borrowed)
                    <tr>
                        <td>{{ $loop->iteration  }}</td>
                        <td style="font-size: small;" class="text-center">{{ $borrowed->borrowing_code }}</td>
                        <td style="font-size: small;">{{ $borrowed->user->name }}</td>
                        <td style="font-size: small;" class="text-center">{{ $borrowed->borrow_date }}</td>
                        <td style="font-size: small;" class="text-center">{{ $borrowed->return_date }}</td>
                        <td style="font-size: small;" class="text-center">{{ $borrowed->notes }}</td>
                        <td style="font-size: small;" class="text-center">{{ $borrowed->status }}</td>
                        <td style="font-size: small;">{{ $borrowed->admin->name }}</td>
                        <td class="justify-content-center">
                            <button class="btn btn-sm btn-primary"
                                data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasStart{{ $borrowed->borrowing_code }}"
                                aria-controls="offcanvasStart">
                                <i class="fa-solid fa-circle-info fa-sm"></i>
                            </button>
                            <div
                                class="offcanvas offcanvas-start"
                                tabindex="-1"
                                id="offcanvasStart{{ $borrowed->borrowing_code }}"
                                aria-labelledby="offcanvasStartLabel">
                                <div class="offcanvas-header">
                                    <h5 id="offcanvasStartLabel" class="offcanvas-title text-center">Detail of {{ $borrowed->borrowing_code }}</h5>
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
                                            @foreach ($borrowed->detail as $item )
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
        $('#borrowingTable').DataTable();
    });
</script>
@endpush