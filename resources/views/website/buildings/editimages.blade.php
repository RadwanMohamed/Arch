@extends('website.buildings.layout')

@section('tab-content')
    <div class="btn-group" role="group" aria-label="..." style="margin-left:280px; margin-top: 150px">
        <button type="button" class="btn btn-secondary images-btn"> تعديل صور العقار</button>
        <button type="button" class="btn btn-secondary info-btn">تعديل معلومات العقار</button>

    </div>


    <div class="row">
        <div class="col-lg-12" style="margin-top: 20px;">
            <div id="result"></div>

        @foreach($building->images as $image)
                <div class="col-sm-2 pull-right building-image">

                    <div class=" pull-left">
                        <form action="{{route('buildings.images.destroy',['image'=>$image->id,'building' => $building->id])}}"
                            method="post">
                            @csrf
                            @method('DELETE')

                            <button class="glyphicon glyphicon-remove delete-image"
                                    style="display: none; border: none; background-color:white;">
                            </button>
                        </form>

                    </div>
                    <div class=" pull-right">
                        <a href="/{{$building->id}}/images/{{$image->id}}" class="glyphicon glyphicon-wrench edit-image" style="color: #0f0f0f !important; display: none">

                        </a>
                    </div>
                    <img class="img-thumbnail" src="{{Request::root()}}/{{$image->image_url}}"
                         title="{{$building->name}}">


                </div>
            @endforeach
        </div>

    </div>
<div class="row">
    <div class="col-lg-12">
        <div class="image-form-edit" style="display: none">
            <form action=''  method='POST' enctype='multipart/form-data' class="form-edit">
                @csrf
                @method('PUT')

                <div class='row register-form' style='margin-right: 90px' >
                    <div class='col-lg-8 pull-left'>

                        <div class='{{$errors->has('images') ? ' has-error' : '' }}'>
                            <label for='name' style='float: right'> تعديل صورة العقار </label>
                            <input type='file'  name='images' placeholder='اضف صور للعقار'class='form-control'>

                            @if ($errors->has('images'))
                                <span class='help-block'>

                                            <strong>
                                                 {{ $errors->first('images') }}
                                             </strong>

                                         </span>
                            @endif
                        </div>
                        <button class='btnRegister'>    تعديل صور العقار  </button>
                    </div>
                </div>

            </form>

        </div>

    </div>

</div>
@endsection






@section('footer')
        <script>
        $(document).on('click','.images-btn',function (e) {
            e.preventDefault();
            $('.image-form-edit').fadeOut();
            $('.building-image').fadeIn();
        });
        $(document).on('click','.info-btn',function (e) {
            e.preventDefault();
            $(location).attr('href','/buildings/{{$building->id}}/edit');

        });

        $('.building-image').bind('mouseover', function () {
            $("a", this).fadeIn();
            $("button", this).fadeIn();

        });
        $('.building-image').bind('mouseleave', function () {
            $("a", this).fadeOut();
            $("button", this).fadeOut();

        });


        $(document).on('click','.delete-image',function (e) {
            e.preventDefault();
            image = $(this).parents('.building-image');
            form  =  $(this).parents('form');
            url = form.attr('action');
            data = form.serializeArray();
            var response = window.confirm("هل ترغب حقا فى حذف هذه الصورة");

            if(response == true)
            {
                $.ajax({
                    url  : url,
                    type : 'POST',
                    dataType : 'JSON',
                    data : data,
                    success:function (data) {
                        $('#result').addClass('alert alert-success').html(data.msg).delay(2000).fadeOut();
                        image.fadeOut(function () {
                            image.remove();
                        });

                    },
                    error:function (data) {
                        $('#result').addClass('alert alert-danger').html(data.msg);

                    }

                });
            }
        });

        $(document).on('click','.edit-image',function (e) {
            e.preventDefault();
           var url = $(this).attr('href');
           $('.form-edit').attr('action',url);
           $('.building-image').fadeOut();
           $('.image-form-edit').fadeIn();
        });

    </script>



@endsection





