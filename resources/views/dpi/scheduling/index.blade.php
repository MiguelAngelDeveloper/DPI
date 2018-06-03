@extends('dpi/index')
@section('content')
  <ol class="breadcrumb">
    <li class="breadcrumb-item active">
      <a href="{{ URL::to('scheduling') }}">@lang('dpi.scheduling')</a>
    </li>
  </ol>
<h1>@lang('dpi.scheduling')</h1>
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
              <td>@lang('dpi.id')</td>
              <td>@lang('dpi.name')</td>
              <td>@lang('dpi.code')</td>
              <td>@lang('dpi.zone')</td>
              <td>@lang('dpi.actions')</td>
          </tr>
      </thead>
      <tbody>
      @foreach($scheduling as $key => $value)
          <tr>
              <td>{{ $value->id }}</td>
              <td>{{ $value->name }}</td>
              <td>{{ $value->code }}</td>
              <td>{{ $value->zone }}</td>
              <td>
                {{ Form::open(array('url' => 'scheduling/' . $value->id, 'class' => 'visible-lg-inline')) }}
                    {{ Form::hidden('_method', 'DELETE') }}

                  <a class="btn btn-small btn-info" data-toggle="tooltip"  title="@lang('dpi.view')" href="{{ URL::to('scheduling/' . $value->id) }}"><i class="fa fa-eye"></i></a>
                  <a class="btn btn-small btn-info"  data-toggle="tooltip"  title="@lang('dpi.update')" href="{{ URL::to('scheduling/' . $value->id . '/edit') }}"><i class="fa fa-edit"></i></a>
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
