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
            <li class="breadcrumb-item"><a href="#">{{__('translation.shifts')}}</a></li>
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
                      {{__('translation.shift_management')}}
                    </h5>
                  </div>
                    <div class="col-sm-12 form-inline">
                      <div class="col-sm-6 form-group">
                        <button id="show-modal" class="btn btn-primary btn-cons" data-toggle="modal" data-target="#addShiftModal"><i class="fa fa-plus"></i> {{__('translation.add_row')}}
                        </button>
                        <input id="search-field" type="text" placeholder="{{__('translation.search')}}" class="form-control" autocomplete="off">
                      </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="card-body">
                  <table class="table table-striped" id="shiftTable" data-filter="#search-field">
                    <thead>
                      <tr>
                        <th>{{__('translation.name')}}</th>
                        <th>{{__('translation.team')}}</th>
                        <th>{{__('translation.amount_hours')}}</th>
                        <th style="width: 140px;">{{__('translation.color')}}</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($shifts as $value)
                        <tr>
                          <td>{{$value->name}}</td>
                          <td>{{$value->team->name}}</td>
                          <td>{{$value->hours}}</td>
                          <td><div class="{{$value->color}} text-white" style="padding: 10px;">{{$value->color}}</div></td>
                          <td>
                            <button type="button" class="btn btn-success edit-shift btn-xs" shift-id="{{$value['id']}}" data-toggle="modal" data-target="#editShiftModal"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger delete-shift btn-xs" shift-id="{{$value['id']}}" data-toggle="modal" data-target="#deleteShiftModal"><i class="fa fa-remove"></i></button>
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
<div class="modal fade slide-up disable-scroll" id="addShiftModal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal-dialog ">
    <div class="modal-content-wrapper">
      <div class="modal-content">
        <div class="modal-header clearfix text-left">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
          </button>
          <h5><span class="semi-bold">{{__('translation.add_shift')}}</span></h5>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="{{config('domain')}}/shift/add">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>{{__('translation.shift_name')}}</label>
                  <input type="text" class="form-control" name="name">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>{{__('translation.shift_member')}}</label>
                  <select class="form-control select2" name="team_id">
                    @foreach ($teams as $value)
                      <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>{{__('translation.color')}}</label>
                  <select class="form-control select2" name="color">
                      <option value="bg-primary">Primary</option>
                      <option value="bg-complete">Complete</option>
                      <option value="bg-success">Success</option>
                      <option value="bg-info">Info</option>
                      <option value="bg-danger">Danger</option>
                      <option value="bg-warning">Warning</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>{{__('translation.amount_hours')}}</label>
                  <input type="number" class="form-control" name="hours">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-8">
              </div>
              <div class="col-md-4 m-t-10 sm-m-t-10">
                <button type="submit" class="btn btn-primary btn-block m-t-5">{{__('translation.add')}}</button>
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
<div class="modal fade slide-up disable-scroll" id="editShiftModal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal-dialog ">
    <div class="modal-content-wrapper">
      <div class="modal-content">
        <div class="modal-header clearfix text-left">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
          </button>
          <h5><span class="semi-bold">{{__('translation.edit_shift')}}</span></h5>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="{{config('domain')}}/shift/update">
            <input type="hidden" name="shift_id" value="">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>{{__('translation.shift_name')}}</label>
                  <input type="text" class="form-control" name="name">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>{{__('translation.shift_member')}}</label>
                  <select class="form-control select2" name="team_id">
                    @foreach ($teams as $value)
                      <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>{{__('translation.color')}}</label>
                    <select class="form-control select2" name="color">
                      <option value="bg-primary">Primary</option>
                      <option value="bg-complete">Complete</option>
                      <option value="bg-success">Success</option>
                      <option value="bg-info">Info</option>
                      <option value="bg-danger">Danger</option>
                      <option value="bg-warning">Warning</option>
                    </select>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>{{__('translation.amount_hours')}}</label>
                  <input type="number" class="form-control" name="hours">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7">
              </div>
              <div class="col-md-5 m-t-10 sm-m-t-10">
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

<div class="modal fade slide-up disable-scroll" id="deleteShiftModal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content-wrapper">
      <div class="modal-content">
        <div class="modal-header clearfix text-left">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
          </button>
          <h5 style="width: 100%; text-align: center;"><span class="semi-bold">{{__('translation.confirm_delete_string')}}</span></h5>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="{{config('domain')}}/shift/delete">
            <input type="hidden" name="shift_id" >
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
@stop
