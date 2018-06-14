@extends('dpi/index')
@section('content')
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ URL::to('scheling') }}">@lang('dpi.scheduling')</a>
    </li>
    <li class="breadcrumb-item active">@lang('dpi.newScheduling')</li>
  </ol>

  <!-- if there are creation errors, they will show here -->
  @if($errors->all())
    <div class="alert alert-danger">
    @foreach ($errors->all() as $key => $error)
      <div>{{$error}}</div>
    @endforeach
    </div>
  @endif
    <h1 class="">@lang('dpi.newScheduling')</h1>
{{ Form::open(['url' => 'scheduling/search', 'autocomplete' => 'off', 'class' =>'form-inline']) }}

<div class="form-group mb-2">
  {{ Form::label('channel', __('dpi.channel_name'), array('class' => 'mr-2')) }}
<div>
  <select name="channel">
    @foreach($channels as $channel)
        <option value="{{$channel->id}}">{{$channel->name}}</option>
    @endforeach
  </select>
</div>
</div>
<div class="form-group mx-sm-3 mb-2">
  {{ Form::label('init_date', __('dpi.init_date'), array('class' => 'mr-2')) }}
  {{ Form::text('init_date', null, ['class' => 'form-control', 'id' =>'sch_init_date']) }}
</div>
<button type="submit" class="btn btn-primary mb-2">@lang('dpi.search')</button>
{{ Form::close() }}
@if(isset($freeWindows) && $freeWindows->isNotEmpty())
  <h5>Ventanas libres</h5>
  @foreach ($freeWindows as $key => $window)
<div class="mb-2">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalScheduling{{$window->id}}">
      <p>@lang('dpi.init_date'): {{ $window->init_date }}</p>
      <p>@lang('dpi.duration'): {{ $window->duration }}</p>
    </button>
</div>
      <!-- Modal -->
    @include('dpi.scheduling.modal', ['window' => $window])

  @endforeach
@endif
@if(isset($populatedWindows) && $populatedWindows->isNotEmpty())
  <h5>Ventanas populadas</h5>
  @foreach ($populatedWindows as $key => $window)
    <p>{{ $window->init_date }}</p>
  @endforeach
@endif
@stop
