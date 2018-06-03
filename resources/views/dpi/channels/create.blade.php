@extends('dpi/index')
@section('content')
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ URL::to('channels') }}">@lang('dpi.channels')</a>
    </li>
    <li class="breadcrumb-item active">@lang('dpi.insert')</li>
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
    <h1 class="">@lang('dpi.insert')</h1>
{{ Form::open(['url' => 'channels', 'autocomplete' => 'off']) }}

    <div class="form-group mt-3">
    {{ Form::label('name', __('dpi.channel_name')) }}
    {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
     <div class="form-row">
       <div class="col">
    {{ Form::label('code', __('dpi.code')) }}
    {{ Form::text('code', null, ['class' => 'form-control',  'maxlength' => 2]) }}
    </div>
    <div class="col">
    {{ Form::label('zone', __('dpi.zone')) }}
    {{ Form::text('zone', null, ['class' => 'form-control',  'maxlength' => 3]) }}
      </div>
    </div>
</div>
  <div class="form-group">
    <button type="submit" class="btn btn-info">
      @lang('dpi.insert')
    </button>
</div>
</div>
{{ Form::close() }}
</div>
@stop
