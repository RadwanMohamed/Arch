<ul class="sidebar-menu" data-widget="tree">


    <li class="header"> قائمة الانتقال السريع  </li>

    <li class=" treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>الرئيسية</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-left"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="active"><a href="{{url('/adminpanel')}}"><i class="fa fa-circle-o"></i>  احصائيات الموقع  </a></li>
            <li ><a href="{{url('/adminpanel/stat')}}"><i class="fa fa-circle-o"></i> احصائيات بالسنة  </a></li>
        </ul>
    </li>
    <li class=" treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>اعدادات الموقع</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-left"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="active"><a href="{{url('/admin-panel/site/settings')}}"><i class="fa fa-circle-o"></i> الاعدادات الرئيسية  </a></li>
            <li ><a href="{{url('/admin-panel/site/settings/slider')}}"><i class="fa fa-circle-o"></i> اعدادات السليدر  </a></li>
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

    {{--  العقارات  --}}

    <li class=" treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span> العقارات </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-left"></i>
            </span>
        </a>

        <ul class="treeview-menu">
            <li class="active"><a href="{{url('/admin-panel/buildings')}}"><i class="fa fa-circle-o"></i> عرض جميع العقارات  </a></li>
            <li class="active"><a href="{{url('/admin-panel/users/'.Auth::id().'/buildings')}}"><i class="fa fa-circle-o"></i> عرض جميع العقارات  الخاصة بي  </a></li>
            <li><a href="{{url('/admin-panel/buildings/create')}}"><i class="fa fa-circle-o"></i>  اضف عقار جديد  </a></li>
            <li><a href="{{url('/admin-panel/buildings/mybuildings')}}"><i class="fa fa-circle-o"></i> عرض العقارات الخاصة بي  </a></li>
        </ul>
    </li>
    <li class=" treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>  الرسائل </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-left"></i>
            </span>
        </a>

        <ul class="treeview-menu">
            <li class="active"><a href="{{url('/admin-panel/contacts')}}"><i class="fa fa-circle-o"></i> عرض جميع الرسائل  </a></li>
        </ul>
    </li>




</ul>
