@extends('dpi/index')
@section('content')
  <ol class="breadcrumb">
    <li class="breadcrumb-item active">
      <a href="{{ URL::to('channels') }}">@lang('dpi.channels')</a>
    </li>
  </ol>
<h1>@lang('dpi.channels')</h1>
<?php $message = Session::get('message');?>
@if($message)
  <div class="alert alert-success">
  <strong>@lang('dpi.success')</strong> {{  Session::get('message') }}
  </div>
@endif
@if($errors->all())
  <div class="alert alert-danger">
  @foreach ($errors->all() as $key => $error)
    <div>{{$error}}</div>
  @endforeach
  </div>
@endif
<div class="text-center justify-content-center d-flex">
  <table class="table table-hover table-responsive">
      <thead class="thead-dark">
          <tr>
              <th>@lang('dpi.id')</th>
              <th>@lang('dpi.name')</th>
              <th>@lang('dpi.code')</th>
              <th>@lang('dpi.zone')</th>
              <th>@lang('dpi.actions')</th>
          </tr>
      </thead>
      <tbody>
      @foreach($channels as $key => $value)
          <tr>
              <td>{{ $value->id }}</td>
              <td>{{ $value->name }}</td>
              <td>{{ $value->code }}</td>
              <td>{{ $value->zone }}</td>
              <td>
                {{ Form::open(array('url' => 'channels/' . $value->id, 'class' => 'visible-lg-inline')) }}
                    {{ Form::hidden('_method', 'DELETE') }}

                  <a class="btn btn-small btn-info" data-toggle="tooltip"  title="@lang('dpi.view')" href="{{ URL::to('channels/' . $value->id) }}"><i class="fa fa-eye"></i></a>
                  <a class="btn btn-small btn-info"  data-toggle="tooltip"  title="@lang('dpi.update')" href="{{ URL::to('channels/' . $value->id . '/edit') }}"><i class="fa fa-edit"></i></a>
                  <button type="submit" class="btn btn-info"  data-toggle="tooltip"  title="@lang('dpi.remove')">
                    <i class="fa fa-trash"></i>
                  </button>
                  {{ Form::close() }}
              </td>
          </tr>
      @endforeach
      </tbody>
  </table>
</div>
@stop
