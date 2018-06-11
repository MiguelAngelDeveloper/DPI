@extends('dpi/index')
@section('content')
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ URL::to('scheling') }}">@lang('dpi.scheduling')</a>
    </li>
    <li class="breadcrumb-item active">@lang('dpi.insert')</li>
  </ol>

  <!-- if there are creation errors, they will show here -->
  @if($errors->all())
    <div class="alert alert-danger">
    @foreach ($errors->all() as $key => $error)
      <div>{{$error}}</div>
    @endforeach
    </div>
  @endif
    <h1 class="">@lang('dpi.insert')</h1>
{{ Form::open(['url' => 'scheduling', 'autocomplete' => 'off', 'class' =>'form-inline']) }}

<div class="form-group mb-2">
  {{ Form::label('name', __('dpi.channel_name'), array('class' => 'mr-2')) }}
<div>
  <select name="name">
    @foreach($channels as $channel)
        <option value="{{$channel->id}}">{{$channel->name}}</option>
    @endforeach
  </select>
</div>
</div>
<div class="form-group mx-sm-3 mb-2">
  {{ Form::label('init_date', __('dpi.init_date'), array('class' => 'mr-2')) }}
  {{ Form::text('init_date', null, ['class' => 'form-control', 'id' =>'init_date']) }}
</div>
<button type="submit" class="btn btn-primary mb-2">@lang('dpi.search')</button>


{{ Form::close() }}

@stop
