@if(session()->has('flash_message'))
    @alert(['level'=>session('flash_message.level'),'message'=>session('flash_message.message')])
    @endalert
@endif
