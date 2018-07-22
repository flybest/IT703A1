@extends('admin/layouts/app')


@section('content')
<div id="page-" class="col-md-4 col-md-offset-4">
    <form class="form loginform" method="POST" action="{{ route('login') }}">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">{{ __('views.admin.signin') }}</div>
            <div class="panel-body">
                @csrf
                <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                    <label class="control-label">{{ __('views.admin.username') }}</label>
                    <input type="text" name="user_name" class="form-control" required="required" value="{{ old('user_name') }}" autofocus>
                    @if ($errors->has('user_name'))
                        <span class="help-block" role="alert">{{ $errors->first('user_name') }}</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="control-label">{{ __('views.admin.password') }}</label>
                    <input type="password" name="password" class="form-control" required="required">
                    @if ($errors->has('password'))
                        <span class="help-block" role="alert">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="checkbox">
                    <label>
                        <input name="remember" type="checkbox" value="1" {{ old('remember') ? 'checked' : '' }}>{{ __('views.admin.remember') }}
                    </label>
                </div>

                <button type="submit" class="btn btn-success loginField" >{{ __('views.admin.login') }}</button>
                {{--<a href="{{route('index')}}" class="pull-right">{{ __('views.admin.homepage') }}</a>--}}
            </div>
        </div>
    </form>
</div>
@stop