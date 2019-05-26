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
            <li class="breadcrumb-item"><a href="#">{{__('translation.payroll')}}</a></li>
            <li class="breadcrumb-item">{{__('translation.management')}}</li>
            <li class="breadcrumb-item active">{{__('translation.edit')}}</li>
          </ol>
          <!-- END BREADCRUMB -->
          <div class="row">
            <div class="col-lg-12">
              <!-- START card -->
              <div class="card card-default">
                <div class="card-header ">
                  <div class="card-title">
                    <h5>
                      {{__('translation.payroll_edit')}}
                    </h5>
                  </div>
                    
                </div>
                <div class="clearfix"></div>
                <div class="card-body">
                  <form role="form" method="post" action="{{config('domain')}}/payroll/update">
                    <input type="hidden" name="payroll_id" value="{{$payroll->id}}" />
                    <input type="hidden" name="hourly_rate" value="{{$payroll->employee->rate_per_hour}}" />
                    <input type="hidden" name="night" value="{{$payroll->employee->extra_charge_night}}" />
                    <input type="hidden" name="saturday" value="{{$payroll->employee->extra_charge_saturday}}" />
                    <input type="hidden" name="sunday" value="{{$payroll->employee->extra_charge_sunday}}" />
                    <input type="hidden" name="feast" value="{{$payroll->employee->extra_charge_feast}}" />
                    <input type="hidden" name="base_salary" value="{{$payroll->employee->base_salary}}" />
                    <input type="hidden" name="payroll_type" value="{{$payroll->type}}" />
                    <input type="hidden" name="total_amount" value="{{$payroll->total_amount}}" />
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label>{{__('translation.employee_name')}}</label>
                          <select class="form-control" name="employee_id">
                            @foreach($employees as $key => $value)
                              <option value="{{$value['id']}}">{{$value['name']}}</option>
                            @endforeach 
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label>{{__('translation.date')}}</label>
                          <input type="text" class="form-control" name="month" value="<?= str_replace("/", ".", $payroll->month);?>">
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label>{{__('translation.type')}}</label>
                          <div class="radio radio-success">
                            <input type="radio" value="0" name="type" id="edityes" <?php if($payroll->type=='0') echo 'checked';?>>
                            <label for="edityes">{{__('translation.basic_salary')}}</label>
                            <input type="radio" value="1" name="type" id="editno" <?php if($payroll->type=='1') echo 'checked';?>>
                            <label for="editno">{{__('translation.hourly_job')}}</label>
                          </div>
                        </div>
                      </div>
                      <div class="hourly-part col-lg-3" style="<?php if($payroll->type=='0') echo 'display: none;';?>">
                        <div class="form-group">
                          <label>{{__('translation.working_hours')}}</label>
                          <input type="number" class="form-control" name="working_hours" value="<?= $payroll->working_hours?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>{{__('translation.saturday_hours')}}</label>
                          <input type="number" class="form-control" name="saturday_hours" value="<?= $payroll->saturday_hours?>">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>{{__('translation.sunday_hours')}}</label>
                          <input type="number" class="form-control" name="sunday_hours" value="<?= $payroll->sunday_hours?>">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>{{__('translation.night_hours')}}</label>
                          <input type="number" class="form-control" name="night_hours" value="<?= $payroll->night_hours?>">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>{{__('translation.feast_hours')}}</label>
                          <input type="number" class="form-control" name="feast_hours" value="<?= $payroll->feast_hours?>">
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-12">
                        <label>{{__('translation.notes')}}</label>
                        <textarea class="form-control" name="note" rows="6"><?= $payroll->note;?></textarea>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-10">
                        <p>{{__('translation.total')}}: <span class="total_amount" style="color: red;">{{$payroll->total_amount}}</span> <span style="color: red;"> €</span></p>
                      </div>
                      <div class="col-md-2 m-t-10 sm-m-t-10">
                        <button type="submit" class="btn btn-primary btn-block m-t-5">{{__('translation.update_send')}}</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@stop
