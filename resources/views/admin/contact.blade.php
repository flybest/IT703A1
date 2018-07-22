@extends('admin.layouts.app')

@section('content')

    <!--Main container start-->
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="page-header" style="border:none;">{{__('views.admin.menu.configuration')}}</h1>
            </div>
            <div class="col-lg-6" style="">
                <div class="page-action-links text-right">
                    <a href="{{route('contacts_add')}}"> <button class="btn btn-success">{{ __('views.admin.add_new') }}</button></a>
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
                <th>{{ __('views.admin.name') }}</th>
                <th>{{ __('views.admin.company') }}</th>
                <th>{{ __('views.admin.role') }}</th>
                <th>{{ __('views.admin.location') }}</th>
                <th>{{ __('views.admin.phone_number') }}</th>
                <th>{{ __('views.admin.email') }}</th>
                <th style="width:15%;">{{ __('views.admin.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{$contact->id}}</td>
                <td>{{(isset($contact->title)&&($contact->title->id!=0)?$contact->title->title:'').' '.$contact->name}}</td>
                <td>{{isset($contact->customer)?$contact->customer->name:''}}</td>
                <td>{{$contact->role}}</td>
                <td>{{$contact->location}}</td>
                <td>{!!'Work: '.$contact->phone_work.($contact->phone_cell==''?'':'<br>Cell: '.$contact->phone_cell).($contact->phone_home==''?'':'<br>Home: '.$contact->phone_home)!!}</td>
                <td>{{$contact->email}}</td>
                <td>
                    <a href="{{ route('contacts_edit', $contact->id) }}" class="btn btn-primary" data-hint="tooltip" title="Edit Contact"><span class="glyphicon glyphicon-edit"></span></a>
                    <a href="javascript:void(0);"  class="btn btn-danger delete_btn" data-toggle="modal" data-target="#confirm-delete-{{$contact->id}}" style="margin-right: 8px;" data-hint="tooltip" title="Delete Contact"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
            </tr>
            @if($contact->notes!='')
            <tr>
                <td colspan="8">
                    <h5>Notes:</h5>
                    <div>{!! nl2br($contact->notes) !!}</div>
                </td>
            </tr>
            @endif
            <!-- Delete Confirmation Modal-->
            <div class="modal fade" id="confirm-delete-{{$contact->id}}" role="dialog">
                <div class="modal-dialog">
                    <form action="{{route('contacts')}}" method="POST">
                        <!-- Modal content-->
                        <div class="modal-content">
                            @csrf
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">{{ __('views.admin.confirm') }}</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="del_id" id = "del_id" value="{{$contact->id}}">
                                <p>{{ __('views.admin.contacts.confirm_message') }}</p>
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
            {{ $contacts->appends(__field($query,['order','filter']))->links() }}
        </div>
        <!--    Pagination links end-->
    </div>
    <!--Main container end-->
@stop