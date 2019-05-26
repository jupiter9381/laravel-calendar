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
            <li class="breadcrumb-item"><a href="#">{{__('translation.roaster')}}</a></li>
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
                      {{__('translation.roaster_management')}}
                    </h5>
                  </div>
                    <div class="col-sm-12 form-inline">
                      <div class="col-sm-6 form-group">
                        <button id="show-modal" class="btn btn-primary btn-cons" data-toggle="modal" data-target="#addRoasterModal"><i class="fa fa-plus"></i> {{__('translation.add_row')}}
                        </button>
                        <input id="search-field" type="text" placeholder="{{__('translation.search')}}" class="form-control" autocomplete="off">
                      </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="card-body">
                  <table class="table table-striped" id="teamTable" data-filter="#search-field">
                    <thead>
                      <tr>
                        <th>{{__('translation.team_name')}}</th>
                        <th>{{__('translation.date')}}</th>
                        <th>{{__('translation.hours')}}</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($roasters as $value)
                        <tr>
                          <td>{{$value->team_name}}</td>
                          <td>{{$value->month}}</td>
                          <td>{{$value->hours}}</td>
                          <td>
                            <button type="button" class="btn btn-success detail-roaster btn-xs" data-url="{{config('domain')}}/roasterdetail/{{$value->id}}"><i class="fa fa-edit"></i></button>
                            <?php if(Auth::user()->auth_type == '0') {?>
                            <button type="button" class="btn btn-danger delete-roaster btn-xs" roaster-id="{{$value->id}}" data-toggle="modal" data-target="#deleteRoasterModal"><i class="fa fa-remove"></i></button>
                            <?php }?>
                          </td>
                        </tr>
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
<div class="modal fade slide-up disable-scroll" id="addRoasterModal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal-dialog ">
    <div class="modal-content-wrapper">
      <div class="modal-content">
        <div class="modal-header clearfix text-left">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
          </button>
          <h5><span class="semi-bold">{{__('translation.add_roaster')}}</span></h5>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="{{config('domain')}}/roaster/add">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>{{__('translation.team_name')}}</label>
                  <select class="form-control select2" name="team_id">
                    @foreach ($teams as $value)
                      <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>{{__('translation.date')}}</label>
                  <input type="text" class="form-control"  name="month" value="<?= date('d.m.Y');?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label>{{__('translation.mail_message')}}</label>
                  <textarea class="form-control" rows="7" name="message"></textarea>
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


<div class="modal fade slide-up disable-scroll" id="deleteRoasterModal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content-wrapper">
      <div class="modal-content">
        <div class="modal-header clearfix text-left">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
          </button>
          <h5 style="width: 100%; text-align: center;"><span class="semi-bold">{{__('translation.confirm_delete_string')}}</span></h5>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="{{config('domain')}}/roaster/delete">
            <input type="hidden" name="roaster_id" >
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
