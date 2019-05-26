@extends('layouts.blank')

@section('content')  


<body class="fixed-header menu-pin menu-behind">
    <div class="login-wrapper ">
      <!-- START Login Background Pic Wrapper-->
      <div class="bg-pic">
        <!-- START Background Pic-->
        <img src="images/background_testimonial_2.jpg" data-src="assets/img/demo/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg" data-src-retina="assets/img/demo/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg" alt="" class="lazy">
        <!-- END Background Pic-->
        <!-- START Background Caption-->
        <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
          <h2 class="semi-bold text-white">
          GERMEDA Intranet</h2>
          <p class="small">
            Alle Rechte vorbehalten © 2019 GERMEDA Digital
          </p>
        </div>
        <!-- END Background Caption-->
      </div>
      <!-- END Login Background Pic Wrapper-->
      <!-- START Login Right Container-->
      <div class="login-container bg-white">
        <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
          <img src="{{config('domain')}}/images/logo-header.png" alt="logo" data-src="assets/img/logo.png" data-src-retina="assets/img/logo_2x.png" style="width: 50%;">
          <p class="p-t-35">{{__('translation.login')}}</p>
          <!-- START Login Form -->
          <form id="form-login" class="p-t-15" role="form" action="{{config('domain')}}/login" method="post">
            <!-- START Form Control-->
            <div class="form-group form-group-default">
              <label>{{__('translation.login')}}</label>
              <div class="controls">
                <input type="text" name="email" placeholder="{{__('translation.user_email')}}" class="form-control" required>
              </div>
            </div>
            <!-- END Form Control-->
            <!-- START Form Control-->
            <div class="form-group form-group-default">
              <label>{{__('translation.password')}}</label>
              <div class="controls">
                <input type="password" class="form-control" name="password" placeholder="{{__('translation.Credentials')}}" required>
              </div>
            </div>
            <!-- START Form Control-->
            <div class="form-group ">
              <?php if(isset($error)){?>
              <p style="color: red;">{{$error}}</p>
              <?php }?>
            </div>
            <!-- END Form Control-->
            <button class="btn btn-primary btn-cons m-t-10" type="submit">{{__('translation.sign_in')}}</button>
          </form>
        </div>
      </div>
      <!-- END Login Right Container-->
    </div>

@stop