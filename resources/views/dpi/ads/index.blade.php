@extends('dpi/index')
@section('content')
  <ol class="breadcrumb">
    <li class="breadcrumb-item active">
      <a href="#">@lang('dpi.ads')</a>
    </li>
  </ol>
<h1>@lang('dpi.ads')</h1>
<?php $message = Session::get('message');?>
@if($message)
  <div class="alert alert-success">
  <strong>@lang('dpi.success')</strong> {{  Session::get('message') }}
  </div>
@endif
<div class="text-center justify-content-center d-flex">
  <table class="table table-hover table-responsive">
      <thead class="thead-dark">
          <tr>
              <th>@lang('dpi.id')</th>
              <th>@lang('dpi.name')</th>
              <th>@lang('dpi.duration')</th>
              <th>@lang('dpi.type')</th>
              <th>@lang('dpi.code')</th>
              <th>@lang('dpi.announcer')</th>
              <th>@lang('dpi.actions')</th>
          </tr>
      </thead>
      <tbody>
      @foreach($ads as $key => $value)
          <tr>
              <td>{{ $value->id }}</td>
              <td>{{ $value->name }}</td>
              <td>{{ $value->duration }}</td>
              <td>{{ $value->tipo }}</td>
              <td>{{ $value->code }}</td>
              <td>{{ $value->announcer }}</td>
              <td>
                {{ Form::open(array('url' => 'ads/' . $value->id, 'class' => 'visible-lg-inline')) }}
                    {{ Form::hidden('_method', 'DELETE') }}

                  <a class="btn btn-small btn-info" data-toggle="tooltip"  title="@lang('dpi.view')" href="{{ URL::to('ads/' . $value->id) }}"><i class="fa fa-eye"></i></a>
                  <a class="btn btn-small btn-info"  data-toggle="tooltip"  title="@lang('dpi.update')" href="{{ URL::to('ads/' . $value->id . '/edit') }}"><i class="fa fa-edit"></i></a>
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
