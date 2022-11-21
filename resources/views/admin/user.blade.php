@extends('admin.admin_master')

@section('content')
<section class="content">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li {{ (isset($list)) ? 'class=active' : '' }}>
                <a href="{{ route('users.index') }}">
                    <i class="fa fa-list" aria-hidden="true"></i> User List
                </a>
            </li>

            <li {{ (isset($create)) ? 'class=active' : '' }}>
                <a href="">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add User
                </a>
            </li>

            @if (isset($edit))
            <li class="active">
                <a href="#">
                    <i class="fa fa-edit" aria-hidden="true"></i> Edit User
                </a>
            </li>
            @endif

            @if (isset($show))
            <li class="active">
                <a href="#">
                    <i class="fa fa-list-alt" aria-hidden="true"></i> User Details
                </a>
            </li>
            @endif
        </ul>

        <div class="tab-content">
            @if(isset($show))
            <div class="tab-pane active">
                <div class="box-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width:120px;">Name</th>
                            <th style="width:10px;">:</th>
                            <td>{{ $data->name }}</td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <th>:</th>
                            <td>{{ $data->mobile }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th>:</th>
                            <td>{{ $data->email }}</td>
                        </tr>
                        <tr>
                            <th>Account Type</th>
                            <th>:</th>
                            <td>{{ $data->type }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <th>:</th>
                            <td>{{ $data->status }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            @elseif(isset($edit) || isset($create))
            <div class="tab-pane active">
                <div class="box-body">
                    <form method="POST" action="" id="are_you_sure" class="form-horizontal" enctype="multipart/form-data">
                        @csrf

                        @if (isset($edit))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="control-label col-sm-3 required">Name:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name" value="{{ old('name', isset($data) ? $data->name : '') }}" required>

                                        @if ($errors->has('name'))
                                            <span class="help-block">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                    <label class="control-label col-sm-3 required">Moblie Number:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <span class="input-group-addon">+88</span>
                                            <input type="text" class="form-control" name="mobile" value="{{ old('mobile', isset($data) ? $data->mobile : '') }}" required pattern="[0-9]{11}" title="11 Digit mobile number without country code">
                                        </div>

                                        @if ($errors->has('mobile'))
                                            <span class="help-block">{{ $errors->first('mobile') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="control-label col-sm-3 required">Email:</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" name="email" value="{{ old('email', isset($data) ? $data->email : '') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label class="control-label col-sm-3 {!! isset($create) ? 'required' : '' !!}">Password:</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" name="password" {{ isset($create) ? 'required' : '' }}>

                                        @if ($errors->has('password'))
                                            <span class="help-block">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3 {!! isset($create) ? 'required' : '' !!}">Confirm password:</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" name="password_confirmation" {{ isset($create) ? 'required' : '' }}>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                    <label class="control-label col-sm-3 required">Account Type</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="type" required>
                                            @php ($type = old('type', isset($data) ? $data->type : ''))
                                            @foreach(['Admin', 'Staff'] as $rl)
                                                <option value="{{ $rl }}" {{ ($rl==$type)?'selected':''}}>{{ $rl }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('type'))
                                            <span class="help-block">{{ $errors->first('type') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                    <label class="control-label col-sm-3 required">Status:</label>
                                    <div class="col-sm-9">
                                        <select name="status" class="form-control" required>
                                            @php ($status = old('status', isset($data) ? $data->status : ''))
                                            @foreach(['Active', 'Deactivated'] as $sts)
                                                <option value="{{ $sts }}" {{ ($status == $sts) ? 'selected' : '' }}>{{ $sts }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('status'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-success btn-flat btn-lg">{{ (isset($edit)) ? 'Update' : 'Create' }}</button>
                                    <button type="reset" class="btn btn-custom btn-flat btn-lg">Clear</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @elseif (isset($list))
            <div class="tab-pane active">
                <form method="GET" action="{{ route('users.index') }}" class="form-inline">
                    <div class="box-header text-right">
                        <div class="row">
                            <div class="form-group">
                                <select class="form-control" name="type">
                                    <option value="">Any Type</option>
                                    @foreach(['Admin', 'Staff'] as $rl)
                                        <option value="{{ $rl }}" {{ (Request::get('type') == $rl) ? 'selected' : '' }}>{{ $rl }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <select name="status" class="form-control">
                                    <option value="">Any Status</option>
                                    @foreach(['Active', 'Deactivated'] as $sts)
                                        <option value="{{ $sts }}" {{ (Request::get('status') == $sts) ? 'selected' : '' }}>{{ $sts }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="q" value="{{ Request::get('q') }}" placeholder="Write your search text...">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-custom btn-flat">Search</button>
                                <a class="btn btn-custom btn-flat" href="{{ route('users.index') }}">X</a>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="box-body table-responsive">
                    <table class="table table-bordered table-hover dataTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Account Type</th>
                                <th>Status</th>
                                <th class="col-action">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($records as $val)
                            <tr>
                                <td>{{ $val->name }}</td>
                                <td>{{ $val->mobile }}</td>
                                <td>{{ $val->email }}</td>
                                <td>{{ $val->type }}</td>
                                <td>{{ $val->status }}</td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-default btn-flat btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Action <span class="caret"></span></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href=""><i class="fa fa-eye"></i> Show</a></li>
                                            <li><a href=""><i class="fa fa-eye"></i> Edit</a></li>
                                            <li><a ><i class="fa fa-close"></i> Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-sm-4 pagi-msg"></div>

                    <div class="col-sm-4 text-center">
                        {{ $records->appends(Request::except('page'))->links() }}
                    </div>

                    <div class="col-sm-4">
                        <div class="pagi-limit-box">
                            <div class="input-group pagi-limit-box-body">
                                <span class="input-group-addon">Show:</span>

                                <select class="form-control pagi-limit" name="limit">

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
