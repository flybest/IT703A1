@extends('admin.layouts.app')

@section('content')
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">{{ isset($customer)?__('views.admin.customers.update_customer'):__('views.admin.customers.add_customer') }}</h2>
        </div>
    </div>
    @include('admin.layouts.error')
    @include('admin.layouts.flash')
    <form class="well form-horizontal" action="{{ isset($customer)?route('customers_edit', $customer):route('customers_add') }}" method="post"  id="customer_form" enctype="multipart/form-data">
        <fieldset>
            <!-- Form Name -->
            <legend>{{ isset($customer)?__('views.admin.customers.update_customer.legend'): __('views.admin.customers.add_customer.legend') }}</legend>
            @csrf
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">{{__('views.admin.company_name')}}</label>
                <div class="col-md-4 inputGroupContainer">
                    <input  type="text" name="name" placeholder="{{__('views.admin.company_name')}}" class="form-control" value="{{ isset($customer)? ($customer->name): old('name') }}" required autocomplete="off">
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">{{__('views.admin.address')}}</label>
                <div class="col-md-4 inputGroupContainer">
                    <input  type="text" name="address1" placeholder="{{__('views.admin.address1')}}" class="form-control" value="{{ isset($customer)? ($customer->address1): old('address1') }}" required autocomplete="off">
                    <input  type="text" name="address2" placeholder="{{__('views.admin.address2')}}" class="form-control" value="{{ isset($customer)? ($customer->address2): old('address2') }}"  autocomplete="off">
                    <input  type="text" name="address3" placeholder="{{__('views.admin.address3')}}" class="form-control" value="{{ isset($customer)? ($customer->address3): old('address3') }}"  autocomplete="off">
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">{{__('views.admin.city')}}</label>
                <div class="col-md-4 inputGroupContainer">
                    <input  type="text" name="city" placeholder="{{__('views.admin.city')}}" class="form-control" value="{{ isset($customer)? ($customer->city): old('city') }}" required autocomplete="off">
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">{{__('views.admin.post_code')}}</label>
                <div class="col-md-4 inputGroupContainer">
                    <input  type="text" name="post_code" placeholder="{{__('views.admin.post_code')}}" class="form-control" value="{{ isset($customer)? ($customer->post_code): old('post_code') }}" required autocomplete="off">
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">{{__('views.admin.postal_address')}}</label>
                <div class="col-md-4 inputGroupContainer">
                    <input  type="text" name="postal_address1" placeholder="{{__('views.admin.postal_address1')}}" class="form-control" value="{{ isset($customer)? ($customer->postal_address1): old('postal_address1') }}" required autocomplete="off">
                    <input  type="text" name="postal_address2" placeholder="{{__('views.admin.postal_address2')}}" class="form-control" value="{{ isset($customer)? ($customer->postal_address2): old('postal_address2') }}"  autocomplete="off">
                    <input  type="text" name="postal_address3" placeholder="{{__('views.admin.postal_address3')}}" class="form-control" value="{{ isset($customer)? ($customer->postal_address3): old('postal_address3') }}"  autocomplete="off">
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">{{__('views.admin.postal_city')}}</label>
                <div class="col-md-4 inputGroupContainer">
                    <input  type="text" name="postal_city" placeholder="{{__('views.admin.postal_city')}}" class="form-control" value="{{ isset($customer)? ($customer->postal_city): old('postal_city') }}" required autocomplete="off">
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">{{__('views.admin.postal_post_code')}}</label>
                <div class="col-md-4 inputGroupContainer">
                    <input  type="text" name="postal_post_code" placeholder="{{__('views.admin.postal_post_code')}}" class="form-control" value="{{ isset($customer)? ($customer->postal_post_code): old('postal_post_code') }}" required autocomplete="off">
                </div>
            </div>
            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-send"></span> {{__('views.admin.save')}}</button>
                </div>
            </div>
        </fieldset>
    </form>
</div>
@stop