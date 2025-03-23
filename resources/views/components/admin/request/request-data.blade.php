@props(['requests'])
<div class="card mb-4">
    <h5 class="card-header text-center">Data of Tool Request</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-striped" id="requestTable">
                <thead>
                    <tr>
                        <th style="font-size: small;">No</th>
                        <th style="font-size: small;">Request Code</th>
                        <th style="font-size: small;">User</th>
                        <th style="font-size: small;" class="text-center">Status</th>
                        <th style="font-size: small;">Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $request)
                    <tr>
                        <td style="font-size: small;">{{ $loop->iteration  }}</td>
                        <td style="font-size: small;">{{ $request->request_code  }}</td>
                        <td style="font-size: small;">{{ $request->user->name  }}</td>
                        <td style="font-size: small;" class="text-center">{{ $request->status  }}</td>
                        <td style="font-size: small;">{{ $request->request_date  }}</td>
                        <td class="d-flex justify-content-center">
                            <button class="btn btn-sm btn-primary"
                                data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasStart{{ $request->request_code }}"
                                aria-controls="offcanvasStart">
                                <i class="bx bx-info-circle text-primary"></i>
                            </button>
                            <div
                                class="offcanvas offcanvas-start"
                                tabindex="-1"
                                id="offcanvasStart{{ $request->request_code }}"
                                aria-labelledby="offcanvasStartLabel">
                                <div class="offcanvas-header">
                                    <h5 id="offcanvasStartLabel" class="offcanvas-title text-center">Detail of {{ $request->request_code }}</h5>
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
                                                <th>Catgory</th>
                                                <th>Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($request->detail->groupBy('category_id') as $item=>$detail)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $detail->first()->category->name }}</td>
                                                <td>x{{ $detail->count() }}</td>
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
                        <td colspan="6" class="text-center">No Request Found!</td>
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
        $('#requestTable').DataTable();
    });
</script>
@endpush