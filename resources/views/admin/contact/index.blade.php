
@extends('admin.layouts.app')


@section('title')
الرسائل
@endsection



@section('header')
    <!-- DataTables -->
    {!! Html::style('admin/plugins/datatables/dataTables.bootstrap.css') !!}
@endsection



@section('content')

    <section class="content-header">

        <ol class="breadcrumb">
            <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i> الرئيسية </a></li>
            <li class="active"> جدول الرسائل </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <!-- /.box -->

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">عرض جميع الرسائل</h3>
                    </div>
                    <div class="box-header pull-left">

                       <form action="" method="post" id="read">
                           @csrf
                           @method('DELETE')
                           <button class="btn btn-danger btn-circle delete-read" style="margin-top: 5px"> حذف  جميع الرسائل المقروءة  </button>
                       </form>

                        <form action="" method="post" id="all">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-circle delete-all" style="margin-top: 5px">  حذف  جميع الرسائل  </button>
                        </form>

                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="data" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th> رقم الرسالة </th>
                                <th> اسم الرسالة </th>
                                <th> عنوان الرسالة </th>
                                <th>النوعية </th>
                                <th>تاريخ ارسال الرسالة </th>
                                <th> حذف </th>
                            </tr>
                            </thead>
                            <tbody>


                            </tbody>

                        </table>
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
    <!-- DataTables -->
    {!! Html::script('admin/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('admin/plugins/datatables/dataTables.bootstrap.min.js') !!}


    <script type="text/javascript">


        var lastIdx = null;

        $('#data thead th').each( function () {
            if($(this).index()  < 4 && $(this).index()  != 2 && $(this).index()  != 3 ){
                var classname = $(this).index() == 6  ?  'date' : 'dateslash';
                var title = $(this).html();
                $(this).html( '<input type="text" style="width:120px " class="' + classname + '" data-value="'+ $(this).index() +'" placeholder=" البحث '+title+'" />' );
            }
            else if($(this).index() == 2)
            {
                $(this).html( '<select  class="form-control"><option value="اقتراح" selected="selected">اقتراح</option> <option value="استفسار" selected="selected">استفسار</option> <option value="مشكلة" selected="selected">مشكلة</option></select>' );
            }
            else if($(this).index() == 3)
            {
                $(this).html( '<select class="form-control"><option value="0"> جديدة </option><option value="1"> قديمة </option></select>' );

            }

        } );

        var table = $('#data').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url('/admin-panel/contacts/messages') }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'subject', name: 'subject'},
                {data: 'view', name: 'view'},
                {data: 'created_at', name: 'created_at'},
                {data: 'control', name: ''}
            ],
            "language": {
                "url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json"
            },
            "stateSave": false,
            "responsive": true,
            "order": [[0, 'desc']],
            "pagingType": "full_numbers",
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "All"]
            ],
            iDisplayLength: 25,
            fixedHeader: true,

            "oTableTools": {
                "aButtons": [


                    {
                        "sExtends": "csv",
                        "sButtonText": "ملف اكسل",
                        "sCharSet": "utf16le"
                    },
                    {
                        "sExtends": "copy",
                        "sButtonText": "نسخ المعلومات",
                    },
                    {
                        "sExtends": "print",
                        "sButtonText": "طباعة",
                        "mColumns": "visible",


                    }
                ],

                "sSwfPath": "{{ Request::root()  }}/admin/extra/copy_csv_xls_pdf.swf"
            },

            "dom": '<"pull-left text-left" T><"pullright" i><"clearfix"><"pull-right text-right col-lg-6" f > <"pull-left text-left" l><"clearfix">rt<"pull-right text-right col-lg-6" pi > <"pull-left text-left" l><"clearfix"> '
            ,initComplete: function ()
            {
                var r = $('#data tfoot tr');
                r.find('th').each(function(){
                    $(this).css('padding', 8);
                });
                $('#data thead').append(r);
                $('#search_0').css('text-align', 'center');
            }

        });

        table.columns().eq(0).each(function(colIdx) {
            $('input', table.column(colIdx).header()).on('keyup change', function() {
                table
                    .column(colIdx)
                    .search(this.value)
                    .draw();
            });




        });



        table.columns().eq(0).each(function(colIdx) {
            $('select', table.column(colIdx).header()).on('change', function() {
                table
                    .column(colIdx)
                    .search(this.value)
                    .draw();
            });

            $('select', table.column(colIdx).header()).on('click', function(e) {
                e.stopPropagation();
            });
        });


        $('#data tbody')
            .on( 'mouseover', 'td', function () {
                var colIdx = table.cell(this).index().column;

                if ( colIdx !== lastIdx ) {
                    $( table.cells().nodes() ).removeClass( 'highlight' );
                    $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
                }
            } )
            .on( 'mouseleave', function () {
                $( table.cells().nodes() ).removeClass( 'highlight' );
            } );




    </script>

    <script>
        $(document).on('click','.delete-read',function (e) {
            e.preventDefault();
            data = $('#read').serializeArray();
           var check = window.confirm("هل انت واثق من حذف جميع الرسائل المقروءة؟");
           if(check == true)
           {
               $.ajax({
                   url      : '/admin-panel/contacts/read/delete',
                   type     : 'POST',
                   DataType : 'JSON',
                   data     :  data,
                   success  : function (data) {
                    alert(data.msg);

                   },
                   error    : function (data) {

                   }
               });
           }
        });
        $(document).on('click','.delete-all',function (e) {
           e.preventDefault();
            data = $('#all').serializeArray();
            var check = window.confirm("هل انت واثق من حذف جميع الرسائل ؟");
           if(check == true)
           {
               $.ajax({
                   url      : '/admin-panel/contacts/all/delete',
                   type     : 'POST',
                   DataType : 'JSON',
                   data     : data,
                   success  : function (data) {
                       alert(data.msg);
                       $('.box').html(" ")

                   },
                   error    : function (data) {

                   }
               });
           }
        });
    </script>
@endsection


