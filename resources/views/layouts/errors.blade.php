@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            {{$error}}
            @break
        @endforeach
    </div>
@endif
