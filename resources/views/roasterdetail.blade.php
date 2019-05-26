@extends('layouts.default')

@section('content')  

<style type="text/css">
  .fc-time, .fc-left, .fc-right{
    display: none;
  }
  .fc-view{
    margin-top: 15px !important;
  }
</style>
<div class="page-content-wrapper ">
  <div class="content ">
    <div class="jumbotron" data-pages="parallax">
      <div class=" container-fluid   container-fixed-lg sm-p-l-0 sm-p-r-0">
        <div class="inner">
          <!-- START BREADCRUMB -->
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">{{__('translation.roaster_detail')}}</a></li>
            <li class="breadcrumb-item active">{{__('translation.management')}}</li>
          </ol>
          <!-- END BREADCRUMB -->
          <div class="row">
            <div class="col-lg-3" style="margin-top: 65px;">
              <!-- START card -->
              <div class="card card-default">
                <div class="card-header ">
                  <div class="card-title">
                    <h5>
                      {{__('translation.roaster_detail_management')}}
                    </h5>
                  </div>
                </div>
                <div class="card-body">
                  <input type="hidden" name="auth_type" value="{{Auth::user()->auth_type}}">
                  <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                  <input type="hidden" name="roaster_id" value="{{$roaster->id}}">
                  <input type="hidden" name="month" value="{{$roaster->month}}">
                  <div class="row">
                      <div class="col-lg-12">
                          <div id="external-events" class="m-t-20">
                              <?php if(count($shifts) > 0){?>
                              @foreach($employees as $item)
                              <div>
                                <h4 class="semi-bold">{{$item['name']}}</h4>
                                @foreach($shifts as $value)
                                  <div class="external-event {{$value->color}}" data-class="{{$value->color}}" shift-id="{{$value->id}}" employee-id="{{$item['id']}}">
                                    <i class="mdi mdi-checkbox-blank-circle mr-2 vertical-middle"></i>{{$value->name}} {{$item['name']}} ({{$value->hours}})
                                  </div>
                                @endforeach
                                
                              </div>
                              @endforeach
                              <?php }?>
                          </div>
                          <!-- checkbox -->
                          <div class="custom-control custom-checkbox mt-3 d-none" >
                              <input type="checkbox" class="custom-control-input" id="drop-remove" >
                              <label class="custom-control-label" for="drop-remove">Remove after drop</label>
                          </div>
                      </div> <!-- end col-->
                  </div>  
                </div>
              </div>
            </div>
            <div class="col-lg-9">
              <div id="calendar"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Add New Event MODAL -->
<div class="modal fade" id="event-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete event</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div> 
            <div class="modal-body p-3">
            </div>
            <div class="text-right p-3">
                <button type="button" class="btn btn-light " data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger delete-event  " data-dismiss="modal">Delete</button>
            </div>
        </div> <!-- end modal-content-->
    </div> <!-- end modal dialog-->
</div>
@stop