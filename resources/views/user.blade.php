@extends('layouts.default')

@section('content')  


<!-- START PAGE CONTENT WRAPPER -->
<div class="page-content-wrapper ">
  <div class="content ">
    <div class="jumbotron" data-pages="parallax">
      <div class=" container-fluid   container-fixed-lg sm-p-l-0 sm-p-r-0">
        <div class="inner">
          <!-- START BREADCRUMB -->
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">{{__('translation.user')}}</a></li>
            <li class="breadcrumb-item active">{{__('translation.management')}}</li>
          </ol>
          <!-- END BREADCRUMB -->
          <div class="row">
            <div class="col-lg-12">
              <!-- START card -->
              <div class="card card-default">
                <div class="card-header ">
                  <div class="card-title">
                    <h5>
                      {{__('translation.user_management')}}
                    </h5>
                  </div>
                    <div class="col-sm-12 form-inline">
                      <div class="col-sm-6 form-group">
                        <button id="show-modal" class="btn btn-primary btn-cons" data-toggle="modal" data-target="#addUserModal"><i class="fa fa-plus"></i> {{__('translation.add_row')}}
                        </button>
                        <input id="search-field" type="text" placeholder="{{__('translation.search')}}" class="form-control" autocomplete="off">
                      </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="card-body">
                  <table class="table table-striped" id="employeeTable" data-filter="#search-field">
                    <thead>
                      <tr>
                        <th>{{__('translation.name')}}</th>
                        <!-- <th>Address</th> -->
                        <th>{{__('translation.zip')}}</th>
                        <th>{{__('translation.city')}}</th>
                        <th>{{__('translation.email')}}</th>
                        <th>{{__('translation.mobile')}}</th>
                        <!-- <th>Birthday</th> -->
                        <th>{{__('translation.type')}}</th>
                        <th>{{__('translation.rate')}}</th>
                        <th>{{__('translation.salary')}}</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($employees as $key => $value)
                        @if ($value->auth_type == '1')
                          <tr>
                            <td>{{$value['name']}}</td>
                            <!-- <td>{{$value['address']}}</td> -->
                            <td>{{$value['zip']}}</td>
                            <td>{{$value['city']}}</td>
                            <td>{{$value['email']}}</td>
                            <td>{{$value['mobile']}}</td>
                            <!-- <td>{{$value['birthday']}}</td> -->
                            <td>{{$value['type']}}</td>
                            <td>{{$value['rate_per_hour']}}</td>
                            <td>{{$value['base_salary']}}</td>
                            <td><button type="button" class="btn btn-success edit-employee btn-xs" employee-id="{{$value['id']}}" data-toggle="modal" data-target="#editUserModal"><i class="fa fa-edit"></i></button>
                              <button type="button" class="btn btn-success reset-password btn-xs" employee-id="{{$value['id']}}" data-toggle="modal" data-target="#resetPasswordModal"><i class="fa fa-key"></i></button>
                              <button type="button" class="btn btn-success delete-employee btn-xs" employee-id="{{$value['id']}}" data-toggle="modal" data-target="#deleteUserModal"><i class="fa fa-remove"></i></button></td>
                          </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade slide-up disable-scroll" id="addUserModal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content-wrapper">
      <div class="modal-content">
        <div class="modal-header clearfix text-left">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
          </button>
          <h5><span class="semi-bold">{{__('translation.user')}}</span></h5>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="{{config('domain')}}/user/add">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>{{__('translation.name')}}</label>
                  <input type="text" class="form-control" name="name">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>{{__('translation.mobile')}}</label>
                  <input type="text" class="form-control" name="mobile">
                </div>
              </div>
              
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>{{__('translation.email')}}</label>
                  <input type="email" class="form-control" name="email">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>{{__('translation.password')}}</label>
                  <input type="password" class="form-control" name="password">
                </div>
              </div>
            </div>
            <div class="row">
              
              <div class="col-lg-6">
                <div class="form-group">
                  <label>{{__('translation.address')}}</label>
                  <input type="text" class="form-control" name="address">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>{{__('translation.zip')}}</label>
                  <input type="text" class="form-control" name="zip">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>{{__('translation.city')}}</label>
                  <input type="text" class="form-control" name="city">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3">
                <div class="form-group">
                  <label>{{__('translation.birthday')}}</label>
                  <input type="text" class="form-control" name="birthday" placeholder="dd.mm.yyyy">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>{{__('translation.type')}}</label>
                  <select class="form-control" name="type">
                    <option value="fulltime">{{__('translation.full_time')}}</option>
                    <option value="parttime">{{__('translation.part_time')}}</option>
                    <option value="minijob">{{__('translation.mini_job')}}</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>{{__('translation.hour')}} ($/h)</label>
                  <input type="number" class="form-control" name="rate_per_hour">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>{{__('translation.basic_salary')}}</label>
                  <input type="number" class="form-control" name="base_salary">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3">
                <div class="form-group">
                  <label>{{__('translation.night')}}</label>
                  <input type="number" class="form-control" name="extra_charge_night">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>{{__('translation.saturday')}}</label>
                  <input type="number" class="form-control" name="extra_charge_saturday">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>{{__('translation.sunday')}}</label>
                  <input type="number" class="form-control" name="extra_charge_sunday">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>{{__('translation.feast')}}</label>
                  <input type="number" class="form-control" name="extra_charge_feast">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label>{{__('translation.custom_field')}} 1</label>
                  <input type="text" class="form-control" name="custom_field1">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label>{{__('translation.custom_field')}} 2</label>
                  <input type="text" class="form-control" name="custom_field2">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label>{{__('translation.custom_field')}} 3</label>
                  <input type="text" class="form-control" name="custom_field3">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label>{{__('translation.custom_field')}} 4</label>
                  <input type="text" class="form-control" name="custom_field4">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label>{{__('translation.custom_field')}} 5</label>
                  <input type="text" class="form-control" name="custom_field5">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-8">
              </div>
              <div class="col-md-4 m-t-10 sm-m-t-10">
                <button type="submit" class="btn btn-primary btn-block m-t-5">Add</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
</div>
<!-- /.modal-dialog -->

<!-- Modal -->
<div class="modal fade slide-up disable-scroll" id="editUserModal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content-wrapper">
      <div class="modal-content">
        <div class="modal-header clearfix text-left">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
          </button>
          <h5><span class="semi-bold">Edit User</span></h5>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="{{config('domain')}}/user/update">
            <input type="hidden" name="user_id" >
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>{{__('translation.name')}}</label>
                  <input type="text" class="form-control" name="name">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>{{__('translation.mobile')}}</label>
                  <input type="text" class="form-control" name="mobile">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>{{__('translation.email')}}</label>
                  <input type="email" class="form-control" name="email">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>{{__('translation.address')}}</label>
                  <input type="text" class="form-control" name="address">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>{{__('translation.zip')}}</label>
                  <input type="text" class="form-control" name="zip">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>{{__('translation.city')}}</label>
                  <input type="text" class="form-control" name="city">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3">
                <div class="form-group">
                  <label>{{__('translation.birthday')}}</label>
                  <input type="text" class="form-control" name="birthday">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>{{__('translation.type')}}</label>
                  <select class="form-control" name="type">
                    <option value="fulltime">{{__('translation.full_time')}}</option>
                    <option value="parttime">{{__('translation.part_time')}}</option>
                    <option value="minijob">{{__('translation.mini_job')}}</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>{{__('translation.hour')}}($/h)</label>
                  <input type="number" class="form-control" name="rate_per_hour">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>{{__('translation.basic_salary')}}</label>
                  <input type="number" class="form-control" name="base_salary">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3">
                <div class="form-group">
                  <label>{{__('translation.night')}}</label>
                  <input type="number" class="form-control" name="extra_charge_night">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>{{__('translation.saturday')}}</label>
                  <input type="number" class="form-control" name="extra_charge_saturday">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>{{__('translation.sunday')}}</label>
                  <input type="number" class="form-control" name="extra_charge_sunday">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>{{__('translation.feast')}}</label>
                  <input type="number" class="form-control" name="extra_charge_feast">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label>{{__('translation.custom_field')}} 1</label>
                  <input type="text" class="form-control" name="custom_field1">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label>{{__('translation.custom_field')}} 2</label>
                  <input type="text" class="form-control" name="custom_field2">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label>{{__('translation.custom_field')}} 3</label>
                  <input type="text" class="form-control" name="custom_field3">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label>{{__('translation.custom_field')}} 4</label>
                  <input type="text" class="form-control" name="custom_field4">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label>{{__('translation.custom_field')}} 5</label>
                  <input type="text" class="form-control" name="custom_field5">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-8">
              </div>
              <div class="col-md-4 m-t-10 sm-m-t-10">
                <button type="submit" class="btn btn-primary btn-block m-t-5">{{__('translation.update')}}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
</div>

<div class="modal fade slide-up disable-scroll" id="deleteUserModal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content-wrapper">
      <div class="modal-content">
        <div class="modal-header clearfix text-left">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
          </button>
          <h5 style="width: 100%; text-align: center;"><span class="semi-bold">{{__('translation.confirm_delete_string')}}</span></h5>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="{{config('domain')}}/user/delete">
            <input type="hidden" name="user_id" >
            <div class="row">
              <div class="offset-md-7 col-md-5 m-t-10 sm-m-t-10">
                <button type="submit" class="btn btn-primary btn-block m-t-5">{{__('translation.delete')}}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
</div>
<div class="modal fade slide-up disable-scroll" id="resetPasswordModal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal-dialog modal-sm">
    <div class="modal-content-wrapper">
      <div class="modal-content">
        <div class="modal-header clearfix text-left">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
          </button>
          <h5 style="width: 100%; text-align: center;"><span class="semi-bold">{{__('translation.reset_password')}}</span></h5>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="{{config('domain')}}/user/reset" id="resetForm">
            <input type="hidden" name="user_id" >
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label>{{__('translation.new_password')}}</label>
                  <input type="password" class="form-control" name="new_password">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label>{{__('translation.confirm_password')}}</label>
                  <input type="password" class="form-control" name="confirm_password">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <span class="error"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="offset-md-6 col-md-6 m-t-10 sm-m-t-10">
                <button type="button" class="btn btn-primary btn-block m-t-5 reset-btn">{{__('translation.reset')}}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
</div>
@stop
