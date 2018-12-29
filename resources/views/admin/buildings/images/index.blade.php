@extends('admin.layouts.app')


@section('title')
    التحكم فى صور العقارات
@endsection





@section('content')

    <section class="content-header">

        <ol class="breadcrumb">
            <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i> الرئيسية </a></li>
            <li><a href="{{url('admin-panel/buildings/create')}}"> اضافة عقار جديد </a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <!-- /.box -->

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">عرض جميع الصور ل
                            <a href="/admin-panel/buildings/{{$building->id}}/edit">{{$building->name}}</a>
                        </h3>
                    </div>
                    <div class="box-header pull-left" style="margin-top: -40px;">
                            <a href="{{url("admin-panel/buildings/".$building->id."/images/create ")}}">اضف صورة لهذا العقار</a>
                    </div>

                    <div id="result"></div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">

                            @foreach($building->images as $image)
                                <div class="col-sm-2 pull-right building-image">

                                    <div class=" pull-left">
                                        <form action="{{route('buildings.images.destroy',['image'=>$image->id,'building' => $building->id])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                         <button class="glyphicon glyphicon-remove delete-image" style="display: none; border: none; background-color:white;">
                                        </button>
                                        </form>

                                    </div>
                                    <div class=" pull-right">
                                        <a href="{{route("buildings.images.edit",['building' => $building->id,'image'=>$image->id])}}" class="glyphicon glyphicon-pencil" style="color: #0f0f0f !important; display: none">

                                        </a>
                                    </div>
                                    <img class="img-thumbnail" src="{{Request::root()}}/{{$image->image_url}}"
                                             title="{{$building->name}}">



                                </div>
                            @endforeach

                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection



@section('footer')
<script>
    $(document).ready(function(e){
        $(".img-check").click(function(){
            $(this).toggleClass("check");
        });
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

</script>
@endsection


