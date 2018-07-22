@extends('admin.layouts.app')

@section('content')


    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="page-header" style="border:none;">{{__('views.admin.menu.admin_accounts')}}</h1>
            </div>
            <div class="col-lg-6" style="">
                <div class="page-action-links text-right">
                    <a href="{{route('admins_add')}}"> <button class="btn btn-success">{{ __('views.admin.add_new') }}</button></a>
                </div>
            </div>
        </div>
        <hr style="margin-top:0px;">
        @include('admin.layouts.flash')
        <!--    Begin filter section-->
        <div class="well text-center filter-form">
            <form class="form form-inline" action="">
                <label for="input_search" >{{ __('views.admin.search_name') }}</label>
                <input type="text" class="form-control" id="input_search"  name="search_string" value="{{isset($query['search_string'])?$query['search_string']:''}}">
                <label for ="input_order">{{ __('views.admin.order_by') }}</label>
                <select name="filter_col" class="form-control">
                    @foreach($query['filter'] as $keys => $value)
                        <option value="{{$keys}}" {{ (isset($query['filter_col']) && ($query['filter_col']==$keys))?'selected':'' }}>{{$value}}</option>
                    @endforeach
                </select>

                <select name="order_by" class="form-control" id="input_order">
                    @foreach($query['order'] as $keys => $value)
                        <option value="{{$keys}}" {{ (isset($query['order_by']) && ($query['order_by']==$keys))?'selected':'' }}>{{$value}}</option>
                    @endforeach
                </select>
                <input type="submit" value="{{ __('views.admin.search') }}" class="btn btn-primary">

            </form>
        </div>
        <!--   Filter section end-->
        <hr>
        <table class="table table-striped table-bordered table-condensed">
            <thead>
            <tr>
                <th class="header">#</th>
                <th>{{ __('views.admin.name') }}</th>
                <th style="width:30%;">{{ __('views.admin.admin_account.admin_type') }}</th>
                <th style="width:20%;">{{ __('views.admin.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($admins as $admin)
            <tr>
                <td style="height:45px;">{{$admin->id}}</td>
                <td>{{$admin->user_name}}</td>
                <td>{{$admin->admin_type}}</td>
                <td>
                    @if(!$admin->isUltimateAdminUser() || Auth::user()->isUltimateAdminUser())
                        <a href="{{ route('admins_edit', $admin->id) }}" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span></a>
                        @if(!$admin->isUltimateAdminUser() || !Auth::user()->isUltimateAdminUser())
                        <a href="javascript:void(0)" class="btn btn-danger delete_btn" data-toggle="modal" data-target="#confirm-delete-{{$admin->id}}" style="margin-right: 8px;"><span class="glyphicon glyphicon-trash"></span></a>
                        @endif
                    @endif
                </td>
            </tr>
            <!-- Delete Confirmation Modal-->
            <div class="modal fade" id="confirm-delete-{{$admin->id}}" role="dialog">
                <div class="modal-dialog">
                    <form action="" method="POST">
                        <!-- Modal content-->
                        <div class="modal-content">
                            @csrf
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">{{ __('views.admin.confirm') }}</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="del_id" id = "del_id" value="{{$admin->id}}">
                                <p>{{ __('views.admin.admin_account.confirm_message') }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default pull-left">{{ __('views.admin.yes') }}</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('views.admin.no') }}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            @endforeach
            </tbody>
        </table>
        <!--    Pagination links-->
        <div class="text-center">
            {{ $admins->appends(__field($query,['order','filter']))->links() }}
        </div>
    </div>
@stop