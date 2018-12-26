@extends('admin.layouts.app')


@section('title')
    تعديل بيانات عضو
@endsection




@section('header')
    <style>
        @import url(http://fonts.googleapis.com/css?family=Lato:400,700);
        .profile
        {
            font-family: 'Lato', 'sans-serif';
        }
        .profile
        {
            /*    height: 321px;
                width: 265px;*/
            margin-top: 2px;
            padding:1px;
            display: inline-block;
        }
        .divider
        {
            border-top:1px solid rgba(0,0,0,0.1);
        }
        .emphasis
        {
            border-top: 1px solid transparent;
        }

        .emphasis h2
        {
            margin-bottom:0;
        }
        span.tags
        {
            background: #1abc9c;
            border-radius: 2px;
            color: #f5f5f5;
            font-weight: bold;
            padding: 2px 4px;
        }
        .profile strong,span,div{
            text-transform: initial;
        }
.mess{
    border-top: 1px solid rgba(0,0,0,.125);

}
        .action{
            border-left: 1px solid rgba(0,0,0,.125);

        }
        .read{
            border-right: 1px solid rgba(0,0,0,.125);

        }

    </style>
@endsection

@section('content')

    <section class="content-header">

        <ol class="breadcrumb">
            <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i> الرئيسية </a></li>
            <li><a href="{{url('admin-panel/users')}}"> الاعضاء </a></li>
            <li class="active"> تعديل بيانات عضو </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <!-- /.box -->

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">عرض الرسالة </h3>
                    </div>
                    @if (session('message'))
                        <div class="alert alert-danger">
                            {{ session('message') }}
                        </div>
                     @endif
                    <!-- /.box-header -->
                    <div class="box-body">

                    <div class="container">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 pull-right" style="margin-right: 350px">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-radius: 16px;">
                                            <div class="well profile col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                                    <figure>
                                                        <img src="http://www.localcrimenews.com/wp-content/uploads/2013/07/default-user-icon-profile.png" alt="" class="img-circle" style="width:75px;" id="user-img">
                                                    </figure>

                                                    <h5 style="text-align:center;"><strong id="user-name">الاسم</strong></h5>
                                                        <p style="text-align:center;font-size: smaller;" id="user-frid">{{$contact->name}} </p>
                                                    <div class="mess">

                                                    <h5 style="text-align:center;"><strong id="user-name">البريد الالكتروني</strong></h5>
                                                        <p style="text-align:center;font-size: smaller;" id="user-frid">{{$contact->email}} </p></div>
                                                    <div class="mess">

                                                    <h5 style="text-align:center;"><strong id="user-name"> العنوان  </strong></h5>
                                                        <p style="text-align:center;font-size: smaller;" id="user-frid">{{$contact->subject}} </p></div>
                                                <div class="mess">
                                                    <h5 style="text-align:center;"><strong
                                                            id="user-name"> الرسالة</strong></h5>
                                                    <p style="text-align:center;font-size: smaller;"
                                                       id="user-frid">{{$contact->message}} </p>

                                                </div>
                                                    <div class="mess">
                                                        <div class="action pull-right">
                                                            <form action="/admin-panel/contacts/{{$contact->id}}" method="post" id="all">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger btn-circle delete" style="margin-top: 5px; margin-right: -1px;margin-bottom: 4px">  حذف   الرسالة  </button>
                                                            </form>
                                                        </div>
                                                        <div class="read pull-left">
                                                            <form action="/admin-panel/contacts/{{$contact->id}}/notread" method="post" id="all">
                                                                @csrf
                                                                <button class="btn btn-success btn-circle not-read" style="margin-top: 5px">  غير مقروءة  </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
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
    $(document).on('click','.not-read',function (e) {
      e.preventDefault();
        form = $(this).parents();
        data = form.serializeArray();
        url  = form.attr('action');
      var check = window.confirm("جعل هذه الرسالة غير مقروءة؟");
      if(check == true)
      {

          $.ajax({
              url:url,
              data:data,
              dataType:'JSON',
              type : 'POST',
              success : function (data) {
                  alert(data.msg);
              },
              error  : function (data) {

              }
          });
      }

    })
</script>
@endsection

