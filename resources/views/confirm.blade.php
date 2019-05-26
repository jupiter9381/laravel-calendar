@extends('layouts.blank')

@section('content')  

<body class="fixed-header error-page">
	<div class="d-flex justify-content-center full-height full-width align-items-center">
      <div class="error-container text-center">
        <h1 class="bold">Confirm</h1>
        
        <div class="text-center">
          <form class="">
            <div class=" transparent text-left">
            </div>
            <div class="card card-transparent">
              <div class="card-header ">
                <div class="card-title" style="color: red;">

                </div>
              </div>
              <div class="card-body">
                <button class="btn btn-primary btn-cons accept-btn" payroll-id="{{$payroll->id}}" type="button">Accept</button>
                <button class="btn btn-primary btn-cons ask-btn" payroll-id="{{$payroll->id}}" type="button">Ask for Change</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</body>

@stop