@extends('dpi/index')
@section('content')
  <ol class="breadcrumb">
    <li class="breadcrumb-item active">
      <a href="{{ URL::to('reports') }}">@lang('dpi.reports')</a>
    </li>
  </ol>
<h1>@lang('dpi.reports')</h1>
<?php $message = Session::get('message');?>
@if($message)
  <div class="alert alert-success">
  <strong>Success!</strong> {{  Session::get('message') }}
  </div>
@endif
@if($errors->all())
  <div class="alert alert-danger">
  @foreach ($errors->all() as $key => $error)
    <div>{{$error}}</div>
  @endforeach
  </div>
@endif
<span>@lang('dpi.month'): {{ $fileDetail['month'] }} </span>
<span>@lang('dpi.day'): {{ $fileDetail['day'] }} </span>
<span>@lang('dpi.network'): {{ $fileDetail['network'] }} </span>
<span>@lang('dpi.zone'): {{ $fileDetail['zone'] }} </span>
<div class="text-center justify-content-center d-flex">
  <table class="table table-hover table-responsive table-condensed ">
      <thead>
          <tr>
              <td>@lang('dpi.airedSportDate')</td>
              <td>@lang('dpi.scheduledTime')</td>
              <td>@lang('dpi.spotLenght')</td>
              <td>@lang('dpi.actualAiredTime')</td>
              <td>@lang('dpi.actualAiredLength')</td>
              <td>@lang('dpi.actualAiredPosition')</td>
              <td>@lang('dpi.spotId')</td>
              <td>@lang('dpi.statusCode')</td>
          </tr>
      </thead>
      <tbody>
      @foreach($reports as $key => $value)
          <tr>
              <td>{{ $value['airedSportDate'] }}</td>
              <td>{{ $value['scheduledTime'] }}</td>
              <td>{{ $value['spotLenght'] }}</td>
              <td>{{ $value['actualAiredTime'] }}</td>
              <td>{{ $value['actualAiredLength'] }}</td>
              <td>{{ $value['actualAiredPosition'] }}</td>
              <td>{{ $value['spotId'] }}</td>
              <td>{{ $value['statusCode'] }}</td>
          </tr>
      @endforeach
      </tbody>
  </table>
</div>
@stop
