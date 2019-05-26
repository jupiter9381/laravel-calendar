<body class="fixed-header menu-pin menu-behind">
  <!-- BEGIN SIDEBPANEL-->
  <nav class="page-sidebar" data-pages="sidebar">
  <!-- BEGIN SIDEBAR MENU HEADER-->
  <div class="sidebar-header">
    <img src="{{config('domain')}}/assets/img/logo_white.png" alt="logo" class="brand" data-src="assets/img/logo_white.png" data-src-retina="assets/img/logo_white_2x.png" width="78" height="22">
    <div class="sidebar-header-controls">
      <button type="button" class="btn btn-xs sidebar-slide-toggle btn-link m-l-20" data-pages-toggle="#appMenu"><i class="fa fa-angle-down fs-16"></i>
      </button>
      <button type="button" class="btn btn-link d-lg-inline-block d-xlg-inline-block d-md-inline-block d-sm-none d-none" data-toggle-pin="sidebar"><i class="fa fs-12"></i>
      </button>
    </div>
  </div>
  <!-- END SIDEBAR MENU HEADER-->
  <!-- START SIDEBAR MENU -->
  <div class="sidebar-menu">
    <!-- BEGIN SIDEBAR MENU ITEMS-->
    <ul class="menu-items">
      @if (Auth::user()->auth_type == '0')
      <li class="m-t-30">
        <a href="{{config('domain')}}/user"><span class="title">{{__('translation.user')}}</span></a>
        <span class="icon-thumbnail"><i class="pg-social"></i></span>
      </li>
      <li class="">
        <a href="{{config('domain')}}/payroll"><span class="title">{{__('translation.payroll')}}</span></a>
        <span class="icon-thumbnail"><i class="pg-social"></i></span>
      </li>
      <li class="">
        <a href="{{config('domain')}}/team"><span class="title">{{__('translation.teams')}}</span></a>
        <span class="icon-thumbnail"><i class="pg-social"></i></span>
      </li>
      <li class="">
        <a href="{{config('domain')}}/shift"><span class="title">{{__('translation.shifts')}}</span></a>
        <span class="icon-thumbnail"><i class="pg-social"></i></span>
      </li>
      <li class="">
        <a href="{{config('domain')}}/roaster"><span class="title">{{__('translation.roaster')}}</span></a>
        <span class="icon-thumbnail"><i class="pg-social"></i></span>
      </li>
    </ul>
    @endif
    @if (Auth::user()->auth_type == '1')
      <li class="m-t-30">
        <a href="{{config('domain')}}/payroll/user"><span class="title">{{__('translation.payroll')}}</span></a>
        <span class="icon-thumbnail"><i class="pg-social"></i></span>
      </li>
      <li class="">
        <a href="{{config('domain')}}/roaster"><span class="title">{{__('translation.roaster')}}</span></a>
        <span class="icon-thumbnail"><i class="pg-social"></i></span>
      </li>
    @endif
    <div class="clearfix"></div>
  </div>
  <!-- END SIDEBAR MENU -->
  </nav>