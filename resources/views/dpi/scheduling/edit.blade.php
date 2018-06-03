@extends('dpi/index')
@section('content')
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ URL::to('scheling') }}">@lang('dpi.scheduling')</a>
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
{{ Form::open(['url' => 'scheduling', 'autocomplete' => 'off']) }}

<div class="form-row mt-3">
  <div class="col">
  {{ Form::label('name', __('dpi.channel_name')) }}
<div>
  <select name="name">
    @foreach($channels as $channel)
        <option value="{{$channel->id}}">{{$channel->name}}</option>
    @endforeach
  </select>
</div>
</div>
<div class="col">
   {{ Form::label('init_date', 'Fecha de inicio') }}
   {{ Form::text('init_date', null, ['class' => 'form-control', 'id' =>'init_date']) }}
</div>
</div>
    <div class="form-group">
     <div class="form-row">
       <div class="col">
    {{ Form::label('code', 'Código del canal') }}
    {{ Form::text('code', null, ['class' => 'form-control',  'maxlength' => 2]) }}
    </div>
    <div class="col">
    {{ Form::label('zone', 'Zona del canal') }}
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
