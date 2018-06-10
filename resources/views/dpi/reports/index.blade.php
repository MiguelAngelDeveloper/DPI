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
<div class="container text-center justify-content-center d-flex">
  <table class="table table-hover table-responsive">
      <thead>
          <tr>
              <td>@lang('dpi.month')</td>
              <td>@lang('dpi.day')</td>
              <td>@lang('dpi.network')</td>
              <td>@lang('dpi.zone')</td>
          </tr>
      </thead>
      <tbody>
      @foreach($reports as $key => $value)
          <tr>
              <td>{{ $value['month'] }}</td>
              <td>{{ $value['day'] }}</td>
              <td>{{ $value['network'] }}</td>
              <td>{{ $value['zone'] }}</td>
          </tr>
      @endforeach
      </tbody>
  </table>
</div>
@stop
