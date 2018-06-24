@extends('dpi/index')
@section('content')
  <ol class="breadcrumb">
    <li class="breadcrumb-item active">
      <a href="{{ URL::to('reports/create') }}">@lang('dpi.reports')</a>
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
<ul class="list-inline mb-2">
  <li class="list-inline-item justify-content-between align-items-center h3">
    @lang('dpi.month')
    <span class="badge badge-warning inline">{{ $fileDetail['month'] }}</span>
  </li>
  <li class="list-inline-item justify-content-between align-items-center h3">
    @lang('dpi.day')
    <span class="badge badge-warning inline">{{ $fileDetail['day'] }}</span>
  </li>
  <li class="list-inline-item justify-content-between align-items-center h3">
    @lang('dpi.network')
    <span class="badge badge-warning inline">{{ $fileDetail['network'] }}</span>
  </li>
  <li class="list-inline-item justify-content-between align-items-center h3">
    @lang('dpi.zone')
    <span class="badge badge-warning inline">{{ $fileDetail['zone'] }}</span>
  </li>
</ul>

@endif
<div class="text-center justify-content-center d-flex">
  <table class="table table-hover table-responsive table-condensed ">
      <thead class="thead-dark">
          <tr>
              <th>@lang('dpi.airedSpotDate')</th>
              <th>@lang('dpi.scheduledTime')</th>
              <th>@lang('dpi.spotLenght')</th>
              <th>@lang('dpi.actualAiredTime')</th>
              <th>@lang('dpi.actualAiredLength')</th>
              <th>@lang('dpi.actualAiredPosition')</th>
              <th>@lang('dpi.spotId')</th>
              <th>@lang('dpi.statusCode')</th>
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
