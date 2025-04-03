@props(['persent'])
<div class="row justify-content-center">
    <div class="col-"></div>
    <div class="col-md-10">
        <div class="card mb-4">
            @if (session('transToolId'))
            <div class="progress mx-2 my-1">
                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{ $persent }};" aria-valuenow="{{ $persent }}" aria-valuemin="0" aria-valuemax="100">{{ $persent }}</div>
            </div>
            @else
            <div class="progress mx-2 my-1">
                <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 66.6%" aria-valuenow="66.6" aria-valuemin="0" aria-valuemax="100">66.6%</div>
            </div>
            @endif
            <h4 class="text-center my-2">Cart</h4>
            <form action="{{ route('admin.borrowing.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="form-label">Date</label>
                                <input type="date" class="form-control" name="date" required value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" readonly required value="{{ session('transUsername') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" readonly required value="{{ session('transName') }}">
                            </div>
                        </div>
                        <div class="col-md-3" hidden>
                            <div class="form-group">
                                <label for="" class="form-label">User Id</label>
                                <input type="text" class="form-control" name="user_id" readonly required value="{{ session('transId') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="form-label">Notes</label>
                                <textarea name="notes" id="" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-"></div>
                        <div class="col-md-6">
                            <table style="border: 1px solid gray;" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="font-size: small;">Tool Code</th>
                                        <th style="font-size: small;">Tool Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (session('transTools',[]) as $tool)
                                    <tr>
                                        <input type="hidden" name="tool_code[]" value="{{ $tool['toolCode'] }}">
                                        <td style="font-size: small;">{{ $tool['toolCode'] }}</td>
                                        <td style="font-size: small;">{{ $tool['toolName'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if (session('transId'))
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <a href="{{ route('admin.borrowing.trans-tool') }}"><button type="button" class="btn btn-sm btn-primary">&laquo;Back </button></a>
                        </div>
                        <div class="col-md-6 text-end">
                            <button class="btn btn-sm btn-success" type="submit">Submit Cart &raquo;</button>
                        </div>
                    </div>
                    @endif
                </div>
            </form>
            <div class="row mx-2 mb-3">
                <div class="col-md-1">
                    <form action="{{ route('admin.borrowing.cancel') }}" method="post">
                        @csrf
                        <button class="btn btn-sm btn-danger">X</button>
                    </form>
                </div>
            </div>
        </div>
    </div>