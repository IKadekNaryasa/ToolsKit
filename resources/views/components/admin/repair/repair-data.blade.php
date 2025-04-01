@props(['repairs'])
<div class="card mb-4">
    <h5 class="card-header text-center">Data of Reapir</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-striped" id="repairTable">
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
                    @forelse($repairs as $repair)
                    <tr>
                        <td style="font-size: small;">{{ $loop->iteration  }}</td>
                        <td style="font-size: small;">{{ $repair->tool->tool_code }}</td>
                        <td style="font-size: small;">{{ $repair->repair_date }}</td>
                        <td style="font-size: small;">{{ $repair->completion_date }}</td>
                        <td style="font-size: small;">{{ $repair->description }}</td>
                        <td style="font-size: small;" class="text-center">
                            @if ($repair->status === 'done')
                            <i class="badge bg-success" style="text-transform: capitalize;">done</i>
                            @elseif($repair->status === 'in_progress')
                            <i class="badge bg-warning" style="text-transform: capitalize;">in progress</i>
                            @endif
                        </td>
                        <td style="font-size: small;">Rp. {{ number_format($repair->cost,0,',','.') }}</td>
                        <td class="text-center">
                            @if ($repair->status == 'in_progress')
                            <i class="bx bx-time-five" type="button" data-bs-toggle="modal" data-bs-target="#confirmRepairModal-{{ $repair->id }}"></i>
                            @elseif($repair->status == 'done')
                            <i class="bx bx-check"></i>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No Tool on repair Found!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


@foreach ($repairs as $repair)

<div class="modal fade" id="confirmRepairModal-{{ $repair->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Confirm Repair for Tool : {{ $repair->tool->tool_code }}</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.repair.update',['repair' => $repair->id]) }}" method="post">
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
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" value="{{ old('date') ? old('date') : $repair->completion_date }}" name="date" id="date">
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
                                <input type="number" class="form-control @error('cost') invalid @enderror" value="{{ old('cost') ? old('cost') : $repair->cost }}" name="cost" id="cost" placeholder="example : 20000">
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
                                <textarea name="notes" id="notes" class="form-control @error('notes') invalid @enderror">{{ old('notes') ?? $repair->description }}</textarea>
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
        var myModal = new bootstrap.Modal(document.getElementById("confirmRepairModal-{{ old('id') }}"));
        myModal.show();
    });
</script>
@endif
<script>
    $(document).ready(function() {
        $('#repairTable').DataTable();
    });
</script>
@endpush