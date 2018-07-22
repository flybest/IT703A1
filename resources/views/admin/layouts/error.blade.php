@if (count($errors))
    @alert(['message'=>$errors->all()])
    @endalert
@endif