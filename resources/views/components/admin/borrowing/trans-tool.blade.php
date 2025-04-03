@props(['persent'])
<div class="row justify-content-center">
    <div class="col-"></div>
    <div class="col-md-10">
        <div class="card mb-4">
            @if (session('transToolId'))
            <div class="progress mx-2 my-1">
                <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: {{ $persent }}" aria-valuenow="{{ $persent }}" aria-valuemin="0" aria-valuemax="100">{{ $persent }}</div>
            </div>
            @else
            <div class="progress mx-2 my-1">
                <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 33.3%" aria-valuenow="33.3" aria-valuemin="0" aria-valuemax="100">33.3%</div>
            </div>
            @endif
            <h4 class="text-center my-2">New Transaction</h4>
            <div class="card-body">
                <div class="row justify-content-center mb-2">
                    <div class="col-"></div>
                    <div class="col-md-4">
                        <form action="{{ route('admin.borrowing.transTool') }}" method="post">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{ old('tool_code') }}" name="tool_code" required placeholder="input tool code" autofocus>
                                <button class="btn btn-outline-primary" type="submit">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-"></div>
                    <div class="col-md-11">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="font-size: small;">Tool Code</th>
                                    <th style="font-size: small;">Tool Name</th>
                                    <th class="text-center" style="font-size: small;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (session('transTools',[]) as $tool)
                                <tr>
                                    <td style="font-size: small;">{{ $tool['toolCode'] }}</td>
                                    <td style="font-size: small;">{{ $tool['toolName'] }}</td>
                                    <td class="text-center" style="font-size: small;">
                                        <form action="{{ route('admin.borrowing.transToolRemove') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="tool_code" value="{{ $tool['toolCode'] }}">
                                            <button class="btn btn-danger btn-sm" type="submit">X</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if (session('transId'))
                <div class="row justify-content-end my-2">
                    <div class="col-"></div>
                    <div class="col-md-5 text-end">
                        <a href="{{ route('admin.borrowing.new-transaction') }}"><button class="btn btn-sm btn-primary">&laquo;Back </button></a>
                        <a href="{{ route('admin.borrowing.trans-cart') }}"><button class="btn btn-sm btn-primary">Next &raquo;</button></a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>