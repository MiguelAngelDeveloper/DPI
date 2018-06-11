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
@if($fileDetail)
<div class="text-center justify-contentleft d-flex mb-2">
<div class="card card-primary">
  <div class="card-heading">
    <span class="label label-primary">@lang('dpi.month')</span><span class="badge">  {{ $fileDetail['month'] }} </span>
    <span class="label label-primary">@lang('dpi.day')</span><span class="badge">  {{ $fileDetail['day'] }} </span>
    <span class="label label-primary">@lang('dpi.network')</span><span class="badge">  {{ $fileDetail['network'] }} </span>
    <span class="label label-primary">@lang('dpi.zone')</span><span class="badge"> {{ $fileDetail['zone'] }} </span>
  </div>
</div>
</div>
@endif
<div class="text-center justify-content-center d-flex">
  <table class="table table-hover table-responsive table-condensed ">
      <thead>
          <tr>
              <td>@lang('dpi.airedSpotDate')</td>
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
              <td>{{ $value['airedSpotDate'] }}</td>
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
