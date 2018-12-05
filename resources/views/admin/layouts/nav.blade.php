<ul class="sidebar-menu" data-widget="tree">


    <li class="header"> قائمة الانتقال السريع  </li>

    <li class=" treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-left"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
        </ul>
    </li>

    {{--الاعضاء  --}}

    <li class=" treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span> الاعضاء </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-left"></i>
            </span>
        </a>

        <ul class="treeview-menu">
            <li class="active"><a href="{{url('admin-panel/users')}}"><i class="fa fa-circle-o"></i> عرض جميع الاعضاء  </a></li>
            <li><a href="{{url('admin-panel/users/create')}}"><i class="fa fa-circle-o"></i>  اضف عضو جديد  </a></li>
            <li><a href="/admin-panel/admin/{{Auth::user()->id}}/edit"><i class="fa fa-circle-o"></i> تعديل كلمة السر  </a></li>
        </ul>
    </li>




</ul>
