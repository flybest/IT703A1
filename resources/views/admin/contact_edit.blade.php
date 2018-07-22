@extends('admin.layouts.app')

@section('content')
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">{{ isset($contact)?__('views.admin.contacts.update_contact'):__('views.admin.contacts.add_contact') }}</h2>
        </div>
    </div>
    @include('admin.layouts.error')
    @include('admin.layouts.flash')
    <form class="well form-horizontal" action="{{ isset($contact)?route('contacts_edit', $contact):route('contacts_add') }}" method="post"  id="contact_form" enctype="multipart/form-data">
        <fieldset>
            <!-- Form Name -->
            <legend>{{ isset($contact)?__('views.admin.contacts.update_contact.legend'): __('views.admin.contacts.add_contact.legend') }}</legend>
            @csrf
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">{{__('views.admin.person_title')}}</label>
                <div class="col-md-4 inputGroupContainer">
                    <select  type="text" name="title_id" class="form-control" autocomplete="off">
                        @foreach($extra['titles'] as $title)
                            <option value="{{$title->id}}" {{isset($contact)&&($contact->title_id==$title->id)?'selected':(old('title')==$title->id?'selected':'')}}>{{$title->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">{{__('views.admin.name')}}</label>
                <div class="col-md-4 inputGroupContainer">
                    <input  type="text" name="name" placeholder="{{__('views.admin.name')}}" class="form-control" value="{{ isset($contact)? ($contact->name): old('name') }}" required autocomplete="off">
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">{{__('views.admin.company')}}</label>
                <div class="col-md-4 inputGroupContainer">
                    <select name="customer_id" class="form-control" autocomplete="off" {{isset($extra['customer_id'])?'disabled':''}}>
                        @if(isset($extra['customer_id']))
                            <option value="{{$extra['customer_id']}}" selected>{{$extra['customer_id'].'-'.$extra['customer_name']}}</option>
                            <input type="hidden" name="customer_id" value="{{$extra['customer_id']}}">
                        @else
                            <option value="" {{isset($contact)&&($contact->customer_id=='')?'selected':''}}>No Company</option>
                            @foreach($extra['customers'] as $customer)
                                <option value="{{$customer->id}}" {{isset($contact)&&($contact->customer_id==$customer->id)?'selected':(old('customer_id')==$customer->id?'selected':'')}}>{{$customer->id.'-'.$customer->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">{{__('views.admin.role')}}</label>
                <div class="col-md-4 inputGroupContainer">
                    <input  type="text" name="role" placeholder="{{__('views.admin.role')}}" class="form-control" value="{{ isset($contact)? ($contact->role): old('role') }}" required autocomplete="off">
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">{{__('views.admin.location')}}</label>
                <div class="col-md-4 inputGroupContainer">
                    <input  type="text" name="location" placeholder="{{__('views.admin.location')}}" class="form-control" value="{{ isset($contact)? ($contact->location): old('location') }}" required autocomplete="off">
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">{{__('views.admin.phone_work')}}</label>
                <div class="col-md-4 inputGroupContainer">
                    <input  type="text" name="phone_work" placeholder="{{__('views.admin.phone_work')}}" class="form-control" value="{{ isset($contact)? ($contact->phone_work): old('phone_work') }}" required autocomplete="off">
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">{{__('views.admin.phone_cell')}}</label>
                <div class="col-md-4 inputGroupContainer">
                    <input  type="text" name="phone_cell" placeholder="{{__('views.admin.phone_cell')}}" class="form-control" value="{{ isset($contact)? ($contact->phone_cell): old('phone_cell') }}" autocomplete="off">
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">{{__('views.admin.phone_home')}}</label>
                <div class="col-md-4 inputGroupContainer">
                    <input  type="text" name="phone_home" placeholder="{{__('views.admin.phone_home')}}" class="form-control" value="{{ isset($contact)? ($contact->phone_home): old('phone_home') }}" autocomplete="off">
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">{{__('views.admin.email')}}</label>
                <div class="col-md-4 inputGroupContainer">
                    <input  type="email" name="email" placeholder="{{__('views.admin.email')}}" class="form-control" value="{{ isset($contact)? ($contact->email): old('email') }}" required autocomplete="off">
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">{{__('views.admin.notes')}}</label>
                <div class="col-md-4 inputGroupContainer">
                    <textarea name="notes" cols="30" rows="10" placeholder="{{__('views.admin.notes')}}" class="form-control" autocomplete="off">{!! isset($contact)?$contact->notes:old('notes') !!}</textarea>
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