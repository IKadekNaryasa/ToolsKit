@props(['persent'])
<div class="row justify-content-center">
    <div class="col-"></div>
    <div class="col-md-10">
        <div class="card mb-4">
            @if (session('transId'))
            <div class="progress mx-2 my-1">
                <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: {{ $persent }}" aria-valuenow="{{ $persent }}" aria-valuemin="0" aria-valuemax="100">{{ $persent }}</div>
            </div>
            @else
            <div class="progress mx-2 my-1">
                0%
            </div>
            @endif
            <h4 class="text-center my-2">New Transaction</h4>
            <div class="card-body">
                @if (session('transId'))
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <span class="input-group-text" id="addOnUsername">Username</span>
                            <input type="text" readonly disabled class="form-control" aria-describedby="addOnUsername" value="{{ session('transUsername') }}">
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <span class="input-group-text" id="addOnName">Name</span>
                            <input type="text" readonly disabled class="form-control" aria-describedby="addOnName" value="{{session('transName')}}">
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <span class="input-group-text" id="addOnContact">Contact</span>
                            <input type="text" readonly disabled class="form-control" aria-describedby="addOnContact" value="{{ session('transContact') }}">
                        </div>
                    </div>
                </div>
                @endif
                <div class="row justify-content-center my-5">
                    <div class="col-"></div>
                    <div class="col-md-4">
                        <form action="{{ route('admin.borrowing.transUser') }}" method="post">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{ old('username') ?? session('transUsername') }}" name="username" required placeholder="username" autofocus>
                                <button class="btn btn-outline-primary" type="submit">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
                @if (session('transId'))
                <div class="row justify-content-end">
                    <div class="col-"></div>
                    <div class="col-md-2 text-end">
                        <a href="{{ route('admin.borrowing.trans-tool') }}"><button class="btn btn-sm btn-primary">Next &raquo;</button></a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>