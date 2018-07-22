@extends('admin.layouts.app')

@section('content')
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">{{ isset($admin)?__('views.admin.admin_account.update_user'):__('views.admin.admin_account.add_user') }}</h2>
        </div>
    </div>
    @include('admin.layouts.error')
    @include('admin.layouts.flash')
    <form class="well form-horizontal" action="{{ isset($admin)?route('admins_edit', $admin):route('admins_add') }}" method="post"  id="contact_form" enctype="multipart/form-data">
        <fieldset>
            <!-- Form Name -->
            <legend>{{ isset($admin)?__('views.admin.admin_account.update_user.legend'): __('views.admin.admin_account.add_user.legend') }}</legend>
            @csrf
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">{{__('views.admin.username')}}</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input  type="text" name="user_name" placeholder="{{__('views.admin.username')}}" class="form-control" value="{{ isset($admin)? ($admin->user_name): old('user_name') }}" {{ isset($admin)? 'disabled': '' }} required autocomplete="off">
                    </div>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" >{{__('views.admin.password')}}</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" name="password" placeholder="{{__('views.admin.password')}} " class="form-control" autocomplete="off" {{ isset($admin) ? '': 'required' }} {{ (isset($admin) && !$isSelf)?'disabled':'' }}>
                    </div>
                </div>
            </div>
            <!-- radio checks -->
            <div class="form-group">
                <label class="col-md-4 control-label">{{__('views.admin.admin_account.user_type')}}</label>
                <div class="col-md-4">
                    <div class="radio">
                        <label>
                            <input type="radio" name="admin_type" value="super" required {{(isset($admin) && $admin->isUltimateAdminUser())? 'disabled': '' }} {{(isset($admin) && $admin->admin_type=='super')? 'checked': (old('admin_type')=='super')?'checked':'' }}/> {{__('views.admin.admin_account.user_type.super')}}
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="admin_type" value="admin" required {{(isset($admin) && $admin->isUltimateAdminUser())? 'disabled': '' }} {{(isset($admin) && $admin->admin_type=='admin')? 'checked': (old('admin_type')=='admin')?'checked':'' }}/> {{__('views.admin.admin_account.user_type.normal')}}
                        </label>
                    </div>
                </div>
            </div>
            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-warning" {{ (isset($admin) && $admin->isUltimateAdminUser() && !$isSelf)?'disabled':'' }}><span class="glyphicon glyphicon-send"></span> {{__('views.admin.save')}}</button>
                </div>
            </div>
        </fieldset>
    </form>
</div>
@stop