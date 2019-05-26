@extends('layouts.default')

@section('content')  


<!-- START PAGE CONTENT WRAPPER -->
<style type="text/css">
  .ui-datepicker-calendar {
  display: none;
 }
</style>
<div class="page-content-wrapper ">
  <div class="content ">
    <div class="jumbotron" data-pages="parallax">
      <div class=" container-fluid   container-fixed-lg sm-p-l-0 sm-p-r-0">
        <div class="inner">
          <!-- START BREADCRUMB -->
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">{{__('translation.payroll')}}</a></li>
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
                      {{__('translation.payroll_management')}}
                    </h5>
                  </div>
                    <div class="col-sm-12 form-inline">
                      <div class="col-sm-12 form-group">
                        @if (Auth::user()->auth_type == '0')
                        <button id="show-modal" class="btn btn-success btn-cons" data-toggle="modal" data-target="#addPayrollModal"><i class="fa fa-plus"></i> {{__('translation.add_row')}}
                        </button>
                        @endif
                        @if (Auth::user()->auth_type == '1')
                        <input type="text" class="form-control mr-2 filter_month" placeholder="Select a date">
                        @endif
                        <select id="payroll-status" class="custom-select custom-select-sm mr-2">
                            <option value="">{{__('translation.show_all')}}</option>
                            <option >{{__('translation.draft')}}</option>
                            <option >{{__('translation.ask_for_change')}}</option>
                            <option >{{__('translation.accepted')}}</option>
                            <option >{{__('translation.billed')}}</option>
                        </select>
                        <input id="search-field" type="text" placeholder="{{__('translation.search')}}" class="form-control" autocomplete="off">
                      </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="card-body table-responsive">
                  <table class="table table-striped" id="payrollTable" data-filter="#search-field">
                    <thead>
                      <tr>
                        <th>{{__('translation.employee_name')}}</th>
                        <th>{{__('translation.month')}}</th>
                        <th>{{__('translation.amount')}}</th>
                        <th>{{__('translation.payroll_status')}}</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($payrolls as $key => $value)
                        <tr>
                          <td>{{$value->employee->name}}</td>
                          <td>
                            <?php 
                            $date = str_replace(".", "/", $value->month);
                            $date = explode("/", $date)[2].'-'.explode("/", $date)[1].'-'.explode("/", $date)[0];
                            $date = date('F, Y', strtotime($date));
                            echo $date; 
                            ?>
                          </td>
                          <td>{{$value->total_amount}} €</td>
                          <?php if($value->status == "Draft"){
                              $color = "red";
                            } else if($value->status == "Accepted"){
                              $color = "blue";
                            } else if ($value->status == "Ask for change"){
                              $color = "orange";
                            } else {
                              $color = "green";
                            }
                          ?>
                          <td>
                            <span style="color: <?php echo $color;?>; font-weight: 500; ">
                              <?php if($value->status == "Accepted"){?>
                                <?php if(Auth::user()->auth_type == 0){?>
                                  <a href="#confirmBilledModal" data-toggle="modal" payroll-id="{{$value->id}}" class="status_btn" style="text-decoration: underline;">{{__('translation.accepted')}}</a>
                                <?php } else {?>
                                  {{__('translation.accepted')}}
                                <?php }?>
                              <?php } else if($value->status == "Draft"){?>
                                {{__('translation.draft')}}
                              <?php } else if($value->status == "Ask for change"){?>
                                {{__('translation.ask_for_change')}}
                              <?php } else if($value->status == "Billed"){?>
                                {{__('translation.billed')}}
                              <?php }?>
                            </span>
                          </td>
                          <td>
                            <button class="btn btn-success detail_btn btn-xs" type="button" data-toggle="modal" payroll-id="{{$value->id}}" data-target="#detailModal"><i class="fa fa-eye"></i></button>
                            @if ((Auth::user()->auth_type == "1") && ($value->status == "Draft"))
                              <button class="btn btn-info accept_btn btn-xs" type="button" payroll-id="{{$value->id}}" ><i class="fa fa-check-circle"></i></button>
                               <button class="btn btn-success ask_btn btn-xs" type="button" payroll-id="{{$value->id}}" data-toggle="modal" data-target="#askModal"><i class="fa fa-comments" ></i></button>
                            @endif
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
<div class="modal fade slide-up disable-scroll" id="addPayrollModal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content-wrapper">
      <div class="modal-content">
        <div class="modal-header clearfix text-left">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
          </button>
          <h5><span class="semi-bold">{{__('translation.add_payroll')}}</span></h5>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="{{config('domain')}}/payroll/add">
            <input type="hidden" name="hourly_rate" value="{{$employees[0]['rate_per_hour']}}" />
            <input type="hidden" name="night" value="{{$employees[0]['extra_charge_night']}}" />
            <input type="hidden" name="saturday" value="{{$employees[0]['extra_charge_saturday']}}" />
            <input type="hidden" name="sunday" value="{{$employees[0]['extra_charge_sunday']}}" />
            <input type="hidden" name="feast" value="{{$employees[0]['extra_charge_feast']}}" />
            <input type="hidden" name="base_salary" value="{{number_format(floatVal($employees[0]['base_salary']), 2, ',', '.')}}" />
            <input type="hidden" name="total_amount" value="{{number_format(floatVal($employees[0]['base_salary']), 2, ',', '.')}}" />
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>{{__('translation.employee_name')}}</label>
                  <select class="form-control" name="employee_id">
                    @foreach($employees as $key => $value)
                      <option value="{{$value['id']}}">{{$value['name']}}</option>
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
              <div class="col-lg-6">
                <div class="form-group">
                  <div class="radio radio-success">
                    <input type="radio" value="0" name="type" checked id="yes">
                    <label for="yes">{{__('translation.basic_salary')}}</label>
                    <input type="radio" value="1" name="type" id="no">
                    <label for="no">{{__('translation.hourly_job')}}</label>
                  </div>
                </div>
              </div>
              <div class="hourly-part col-lg-4" style="display: none;">
                <div class="form-group">
                  <label>{{__('translation.working_hours')}}</label>
                  <input type="number" class="form-control" name="working_hours" value="0">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>{{__('translation.saturday_hours')}}</label>
                  <input type="number" class="form-control" name="saturday_hours" value="0">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>{{__('translation.sunday_hours')}}</label>
                  <input type="number" class="form-control" name="sunday_hours" value="0">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>{{__('translation.night_hours')}}</label>
                  <input type="number" class="form-control" name="night_hours" value="0">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>{{__('translation.feast_hours')}}</label>
                  <input type="number" class="form-control" name="feast_hours" value="0">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label>{{__('translation.notes')}}</label>
                <textarea class="form-control" name="note" rows="6"></textarea>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-8">
                <p>{{__('translation.total')}}: <span class="total_amount" style="color: red;">{{number_format(floatVal($employees[0]['base_salary']), 2, ',', '.')}}</span> <span style="color: red;"> €</span></p>
              </div>
              <div class="col-md-4 m-t-10 sm-m-t-10">
                <button type="submit" class="btn btn-primary btn-block m-t-5">{{__('translation.create_send')}}</button>
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
<div class="modal fade slide-up disable-scroll" id="detailModal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content-wrapper">
      <div class="modal-content">
        <div class="modal-header clearfix text-left">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
          </button>
          <h5><span class="semi-bold">{{__('translation.payroll_detail')}}</span></h5>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>{{__('translation.employee_name')}}</label>
                  <select class="form-control" name="employee_id">
                    @foreach($employees as $key => $value)
                      <option value="{{$value['id']}}">{{$value['name']}}</option>
                    @endforeach 
                  </select>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>{{__('translation.date')}}</label>
                  <input type="text" class="form-control" id="datepicker-component" name="month" value="<?= date('m/d/Y');?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <div class="radio radio-success">
                    <input type="radio" value="0" name="type" id="detailyes">
                    <label for="detailyes">{{__('translation.basic_salary')}}</label>
                    <input type="radio" value="1" name="type" id="detailno">
                    <label for="detailno">{{__('translation.hourly_job')}}</label>
                  </div>
                </div>
              </div>
              <div class="hourly-part col-lg-4" style="display: none;">
                <div class="form-group">
                  <label>{{__('translation.working_hours')}}</label>
                  <input type="number" class="form-control" name="working_hours" value="0">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>{{__('translation.saturday_hours')}}</label>
                  <input type="number" class="form-control" name="saturday_hours" value="0">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>{{__('translation.sunday_hours')}}</label>
                  <input type="number" class="form-control" name="sunday_hours" value="0">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>{{__('translation.night_hours')}}</label>
                  <input type="number" class="form-control" name="night_hours" value="0">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>{{__('translation.feast_hours')}}</label>
                  <input type="number" class="form-control" name="feast_hours" value="0">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label>{{__('translation.notes')}}</label>
                <textarea class="form-control" name="note" rows="6"></textarea>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-8">
                <p>{{__('translation.total')}}: <span class="total_amount" style="color: red;">0</span> <span style="color: red;"> €</span></p>
              </div>
            </div>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
</div>

<div class="modal fade slide-up disable-scroll" id="confirmBilledModal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content-wrapper">
      <div class="modal-content">
        <div class="modal-header clearfix text-left">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
          </button>
          <h5 style="width: 100%; text-align: center;"><span class="semi-bold">{{__('translation.confirm_delete_string')}}</span></h5>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="{{config('domain')}}/payroll/status">
            <input type="hidden" name="payroll_id" >
            <div class="row">
              <div class="offset-md-9 col-md-3 m-t-10 sm-m-t-10">
                <button type="submit" class="btn btn-primary btn-block m-t-5">{{__('translation.submit')}}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
</div>
<div class="modal fade slide-up disable-scroll" id="askModal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content-wrapper">
      <div class="modal-content">
        <div class="modal-header clearfix text-left">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
          </button>
          <h5 style="width: 100%; text-align: center;"><span class="semi-bold">{{__('translation.ask_for_change')}}</span></h5>
        </div>
        <div class="modal-body">
          <form role="form" method="post">
            <input type="hidden" name="payroll_id" >
            <div class="row">
              <div class="col-md-12">
                <label>{{__('translation.comment')}}</label>
                <textarea class="form-control" name="comment" rows="6"></textarea>
              </div>
            </div>
            <div class="row">
              <div class="offset-md-9 col-md-3 m-t-10 sm-m-t-10">
                <button type="button" class="btn btn-primary btn-block m-t-5 ask_confirm_btn">{{__('translation.submit')}}</button>
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
