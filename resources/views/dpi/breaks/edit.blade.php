@extends('dpi/index')
@section('content')
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ URL::to('breaks') }}">@lang('dpi.breaks')</a>
    </li>
    <li class="breadcrumb-item active">@lang('dpi.updating_break'): {{ $break->id }}</li>
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
{{ Form::model($break, array('route' => array('breaks.update', $break->id), 'method' => 'PUT')) }}
    <div class="form-group mt-3">
    {{ Form::label('name', 'Nombre del canal') }}
    <select name="name">
      @foreach($channels as $channel)
          <option value="{{$channel->id}}"  @if($channel->id==$break->channel_id) selected='selected' @endif>{{$channel->name}}</option>
      @endforeach
    </select>
    </div>
    <div class="form-group">
     <div class="form-row">
       <div class="col">
    {{ Form::label('init_date', 'Fecha de inicio') }}
    {{ Form::text('init_date', null, ['class' => 'form-control', 'id' =>'init_date']) }}
    </div>
    <div class="col">
    {{ Form::label('duration', 'Duración') }}
    {{ Form::text('duration', null, ['class' => 'form-control',  'id' =>'duration']) }}
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