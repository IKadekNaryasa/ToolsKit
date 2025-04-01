@props(['maintenances'])
<div class="card mb-4">
    <h5 class="card-header text-center">Data of Maintenance</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-striped" id="maintenanceTable">
                <thead>
                    <tr>
                        <th style="font-size: small;">No</th>
                        <th style="font-size: small;">Tool Code</th>
                        <th style="font-size: small;" class="col-md-2">Maintenance Date</th>
                        <th style="font-size: small;" class="col-md-2">Finished Date</th>
                        <th style="font-size: small;">Notes</th>
                        <th style="font-size: small;" class="col-md-2 text-center">Status</th>
                        <th style="font-size: small;">Cost</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($maintenances as $maintenance)
                    <tr>
                        <td style="font-size: small;">{{ $loop->iteration  }}</td>
                        <td style="font-size: small;">{{ $maintenance->tool->tool_code }}</td>
                        <td style="font-size: small;">{{ $maintenance->maintenance_date }}</td>
                        <td style="font-size: small;">{{ $maintenance->completion_date }}</td>
                        <td style="font-size: small;">{{ $maintenance->description }}</td>
                        <td style="font-size: small;" class="text-center">
                            @if ($maintenance->status === 'done')
                            <i class="badge bg-success" style="text-transform: capitalize;">done</i>
                            @elseif($maintenance->status === 'in_progress')
                            <i class="badge bg-warning" style="text-transform: capitalize;">in progress</i>
                            @endif
                        </td>
                        <td style="font-size: small;">Rp. {{ number_format($maintenance->cost,0,',','.') }}</td>
                        <td class="text-center">
                            @if ($maintenance->status == 'in_progress')
                            <i class="bx bx-time-five" type="button" data-bs-toggle="modal" data-bs-target="#confirmMaintenanceModal-{{ $maintenance->id }}"></i>
                            @elseif($maintenance->status == 'done')
                            <i class="bx bx-check"></i>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No Tool on maintenance Found!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach ($maintenances as $maintenance)

<div class="modal fade" id="confirmMaintenanceModal-{{ $maintenance->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Confirm Maintenance for Tool : {{ $maintenance->tool->tool_code }}</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.maintenance.update',['maintenance' => $maintenance->id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="status">Status</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="status" id="in_progress" value="in_progress" checked>
                                <label for="in_progress">In Progress</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="status" id="done" value="done">
                                <label for="done">Done</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" value="{{ old('date') ? old('date') : $maintenance->completion_date }}" name=" date" id="date">
                            </div>
                            @error('date')
                            <div id="date" class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="cost">Cost</label>
                                <input type="number" class="form-control @error('cost') invalid @enderror" value="{{ old('cost') ? old('cost') : $maintenance->cost }}" name="cost" id="cost" placeholder="example : 20000">
                            </div>
                            @error('cost')
                            <div id="cost" class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="notes">Notes</label>
                            </div>
                            <div class="form-group">
                                <textarea name="notes" id="notes" class="form-control @error('notes') invalid @enderror">{{ old('notes') ?? $maintenance->description }}</textarea>
                            </div>
                            @error('notes')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
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
        var myModal = new bootstrap.Modal(document.getElementById("confirmMaintenanceModal-{{ old('id') }}"));
        myModal.show();
    });
</script>
@endif
<script>
    $(document).ready(function() {
        $('#maintenanceTable').DataTable();
    });
</script>
@endpush