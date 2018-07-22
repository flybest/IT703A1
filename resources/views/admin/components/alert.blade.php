<div class="alert alert-{{ isset($level)?$level:'danger' }} alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    @if(is_array($message))
        <ul>
            @foreach ($message as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @else
        {{ $message }}
    @endif
</div>