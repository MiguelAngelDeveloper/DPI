@extends('dpi/index')
@section('content')
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ URL::to('ads') }}">@lang('dpi.ads')</a>
    </li>
    <li class="breadcrumb-item active">@lang('dpi.updating_ad'): {{ $ad->name }}</li>
  </ol>

<div class="text-center justify-content-center d-flex container">

<div class="card p-5">
  <!-- if there are creation errors, they will show here -->
  @if($errors->all())
    <div class="alert alert-danger">
    @foreach ($errors->all() as $key => $error)
      <div>{{$error}}</div>
    @endforeach
    </div>
  @endif
    <h1 class="">@lang('dpi.update')</h1>
{{ Form::model($ad, array('route' => array('ads.update', $ad->id), 'method' => 'PUT', 'autocomplete' => 'off')) }}
    <div class="form-group mt-3">
    {{ Form::label('name', __('dpi.name')) }}
    {{ Form::text('name', null, ['class' => 'form-control', 'maxlength' => 100]) }}
    </div>
    <div class="form-group">
     <div class="form-row">
       <div class="col">
       {{ Form::label('duration', __('dpi.duration')) }}
       {{ Form::text('duration', null, ['class' => 'form-control',  'id' => 'duration_ad']) }}
       </div>
       <div class="col">
      {{ Form::label('tipo',__('dpi.type')) }}
      {{ Form::text('tipo', null, ['class' => 'form-control',  'maxlength' => 100]) }}
      </div>
    </div>
  </div>
  <div class="form-group">
   <div class="form-row">
     <div class="col">
    {{ Form::label('code', __('dpi.code')) }}
    {{ Form::text('code', null, ['class' => 'form-control',  'maxlength' => 11]) }}
    </div>
    <div class="col">
    {{ Form::label('announcer', __('dpi.announcer')) }}
    {{ Form::text('announcer', null, ['class' => 'form-control',  'maxlength' => 20]) }}
    </div>
  </div>
</div>
  <div class="form-group">
    <button type="submit" class="btn btn-info">
      @lang('dpi.update')
    </button>
</div>
</div>
{{ Form::close() }}
</div>
@stop
