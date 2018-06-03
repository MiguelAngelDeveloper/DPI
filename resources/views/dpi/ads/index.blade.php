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
  <strong>Success!</strong> {{  Session::get('message') }}
  </div>
@endif
<div class="container text-center justify-content-center d-flex">
  <table class="table table-hover table-responsive">
      <thead>
          <tr>
              <td>@lang('dpi.id')</td>
              <td>@lang('dpi.name')</td>
              <td>@lang('dpi.duration')</td>
              <td>@lang('dpi.type')</td>
              <td>@lang('dpi.code')</td>
              <td>@lang('dpi.announcer')</td>
              <td>@lang('dpi.actions')</td>
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
