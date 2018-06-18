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
  <h5>@lang('dpi.freeWindows')</h5>
  @foreach ($freeWindows as $key => $window)
<div class="mb-2" id="window{{$window->id}}">
  <div>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalScheduling{{$window->id}}">
      <p>@lang('dpi.init_date'): {{ $window->init_date }}</p>
      <p>@lang('dpi.duration'): {{ $window->duration }}</p>
    </button>
  </div>
</div>
      <!-- Modal -->
    @include('dpi.scheduling.modal', ['window' => $window, 'spots' => $spots])

  @endforeach
@endif
@if(isset($populatedWindows) && $populatedWindows->isNotEmpty())
  <h5>@lang('dpi.scheduledWindows')</h5>
  <div class="text-center justify-content-center d-flex">
    <table class="table table-hover table-responsive table-condensed ">
        <thead>
            <tr>
                <td>@lang('dpi.window_init_date')</td>
                <td>@lang('dpi.window_duration')</td>
                <td>@lang('dpi.break_position_in_window')</td>
                <td>@lang('dpi.hoi')</td>
                <td>@lang('dpi.ad_pos_in_break')</td>
                <td>@lang('dpi.ad_name')</td>
                <td>@lang('dpi.ad_duration')</td>
            </tr>
        </thead>
        <tbody>
          @foreach ($populatedWindows as $key => $spot_insertion)
            <tr>
                <td>{{ $spot_insertion->window->init_date }}</td>
                <td>{{ $spot_insertion->window->duration }}</td>
                <td>{{ $spot_insertion->break_position_in_window }}</td>
                <td>{{ $spot_insertion->break->optimal_insertion_date }}</td>
                <td>{{ $spot_insertion->ad_pos_in_break }}</td>
                <td>{{ $spot_insertion->ad->name }}</td>
                <td>{{ $spot_insertion->ad->duration }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
  </div>
@endif
@stop
