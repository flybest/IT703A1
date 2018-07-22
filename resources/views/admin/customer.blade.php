@extends('admin.layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
@endpush

@push('scripts')
    <script src="{{ asset('js/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('js/app-base.js') }}"></script>
    <script src="{{ asset('js/customer.js') }}"></script>
@endpush

@section('content')

    <!--Main container start-->
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="page-header" style="border:none;">{{__('views.admin.menu.appointments')}}</h1>
            </div>
            <div class="col-lg-6" style="">
                <div class="page-action-links text-right">
                    <a href="{{route('customers_add')}}"> <button class="btn btn-success">{{ __('views.admin.add_new') }}</button></a>
                </div>
            </div>
        </div>
        <hr style="margin-top:0px;">
        @include('admin.layouts.flash')
        <!--    Begin filter section-->
        <div class="well text-center filter-form">
            <form class="form form-inline" action="">
                <label for="input_search">{{ __('views.admin.search_name') }}</label>
                <input type="text" class="form-control" id="input_search" name="search_string" value="{{isset($query['search_string'])?$query['search_string']:''}}">
                <label for ="input_order">{{ __('views.admin.order_by') }}</label>
                <select name="filter_col" class="form-control">
                    @foreach($query['filter'] as $keys => $value)
                        <option value="{{$keys}}" {{ (isset($query['filter_col']) && ($query['filter_col']==$keys))?'selected':'' }}>{{$value}}</option>
                    @endforeach
                </select>
                <select name="order_by" class="form-control" id="order_by">
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
                <th>{{ __('views.admin.company') }}</th>
                <th>{{ __('views.admin.address') }}</th>
                <th>{{ __('views.admin.postal_address') }}</th>
                <th style="width:20%;">{{ __('views.admin.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{$customer->id}}</td>
                <td>{{$customer->name}}</td>
                <td>{!! $customer->address1.($customer->address2==''?'':'<br>'.$customer->address2).($customer->address3==''?'':'<br>'.$customer->address3).'<br>'.$customer->city.', '.$customer->post_code !!}</td>
                <td>{!! $customer->postal_address1.($customer->postal_address2==''?'':'<br>'.$customer->postal_address2).($customer->postal_address3==''?'':'<br>'.$customer->postal_address3).'<br>'.$customer->postal_city.', '.$customer->postal_post_code !!}</td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary contact" data-target="{{$customer->id}}" data-hint="tooltip" title="Show Contacts"><span class="glyphicon glyphicon-user"></span></a>
                    <a href="{{ route('contacts_add').'?customer='.$customer->id }}" class="btn btn-success" data-hint="tooltip" title="Add Contact"><span class="glyphicon glyphicon-plus"></span></a>
                    <a href="{{ route('customers_edit', $customer->id) }}" class="btn btn-primary" data-hint="tooltip" title="Edit Customer"><span class="glyphicon glyphicon-edit"></span></a>
                    <a href="javascript:void(0);"  class="btn btn-danger delete_btn" data-toggle="modal" data-target="#confirm-delete-{{$customer->id}}" style="margin-right: 8px;" data-hint="tooltip" title="Delete Customer"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
            </tr>
            <tr id="contact-{{$customer->id}}" class="hidden">
                <td colspan="5">
                    <h4>Contacts:</h4>
                    <div class="info-message"></div>
                    <div class="info-contact">

                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                        </div>

                    </div>
                </td>
            </tr>
            <!-- Delete Confirmation Modal-->
            <div class="modal fade" id="confirm-delete-{{$customer->id}}" role="dialog">
                <div class="modal-dialog">
                    <form action="{{route('customers')}}" method="POST">
                        <!-- Modal content-->
                        <div class="modal-content">
                            @csrf
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">{{ __('views.admin.confirm') }}</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="del_id" id = "del_id" value="{{$customer->id}}">
                                <p>{{ __('views.admin.customers.confirm_message') }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary pull-left">{{ __('views.admin.yes') }}</button>
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
            {{ $customers->appends(__field($query,['order','filter']))->links() }}
        </div>
        <!--    Pagination links end-->
    </div>
    <!--Main container end-->
@stop