<div class="page-container ">
	<!-- START HEADER -->
      <div class="header ">
        <!-- START MOBILE SIDEBAR TOGGLE -->
        <a href="#" class="btn-link toggle-sidebar d-lg-none pg pg-menu" data-toggle="sidebar">
        </a>
        <!-- END MOBILE SIDEBAR TOGGLE -->
        <div class="">
          <div class="brand inline  m-l-10 ">
            <img src="{{config('domain')}}/images/logo-header.png" alt="logo" data-src="{{config('domain')}}/images/logo-header.png" data-src-retina="{{config('domain')}}/images/logo-header.png" width="120" height="40">
          </div>
          <ul class="d-lg-inline-block d-none notification-list no-margin d-lg-inline-block b-grey b-l b-r no-style p-l-30 p-r-20">
            <li class="p-r-10 inline">
              <div class="dropdown">
                <a href="javascript:;" id="notification-center" class="header-icon pg pg-world" data-toggle="dropdown">
                  <span class="bubble exist_ask_request" style="display: none;"></span>
                </a>
                <!-- START Notification Dropdown -->
                <div class="dropdown-menu notification-toggle" role="menu" aria-labelledby="notification-center">
                  <!-- START Notification -->
                  <div class="notification-panel">
                    <!-- START Notification Body-->
                    <div class="notification-body scrollable">
                      <!-- START Notification Item-->
                      <div class="notification-item  clearfix">
                        <div class="heading">
                          <a href="#" class="text-danger pull-left">
                            <i class="fa fa-exclamation-triangle m-r-10"></i>
                            <span class="bold">98% Server Load</span>
                            <span class="fs-12 m-l-10">Take Action</span>
                          </a>
                        </div>
                      </div>
                      <!-- END Notification Item-->
                    </div>
                    <!-- END Notification Body-->
                  </div>
                  <!-- END Notification -->
                </div>
                <!-- END Notification Dropdown -->
              </div>
            </li>
          </ul>
        </div>
        <div class="d-flex align-items-center">
          <!-- START User Info-->
          <div class="pull-left p-r-10 fs-14 font-heading d-lg-block d-none">
            <span class="semi-bold">{{Auth::user()->name}}</span>
          </div>
          <div class="dropdown pull-right d-lg-block d-none">
            <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="thumbnail-wrapper d32 circular inline">
              <img src="{{config('domain')}}/assets/img/profiles/avatar.jpg" alt="" data-src="{{config('domain')}}/assets/img/profiles/avatar.jpg" data-src-retina="{{config('domain')}}/assets/img/profiles/avatar_small2x.jpg" width="32" height="32">
              </span>
            </button>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
              <a href="#" class="dropdown-item"><i class="pg-settings_small"></i> Settings</a>
              <a href="#" class="dropdown-item"><i class="pg-outdent"></i> Feedback</a>
              <a href="#" class="dropdown-item"><i class="pg-signals"></i> Help</a>
              <a href="{{config('domain')}}/logout" class="clearfix bg-master-lighter dropdown-item">
                <span class="pull-left">Logout</span>
                <span class="pull-right"><i class="pg-power"></i></span>
              </a>
            </div>
          </div>
          <!-- END User Info-->
        </div>
      </div>
      <!-- END HEADER -->