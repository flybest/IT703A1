@extends('admin.layouts.app')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{__('views.admin.menu.unauthorised')}}</h1>
            </div>

        </div>
        {{--@include('admin.layouts.flash')--}}
        <!--    Begin filter section-->
        <div class="well text-center filter-form">
            {{__('views.admin.unauthorised.content')}}
        </div>
        <!--   Filter section end-->
    </div>
@stop