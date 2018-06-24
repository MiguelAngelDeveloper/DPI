@extends('dpi/index')
@section('content')
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ URL::to('scheling') }}">@lang('dpi.scheduling')</a>
    </li>
    <li class="breadcrumb-item active">@lang('dpi.getSchedulings')</li>
  </ol>
<?php
$channelId = Session::get('channel');
$schDate = Session::get('schDate');
?>
  <!-- if there are creation errors, they will show here -->
  @if($errors->all())
    <div class="alert alert-danger">
    @foreach ($errors->all() as $key => $error)
      <div>{{$error}}</div>
    @endforeach
    </div>
  @endif
    <h1 class="">@lang('dpi.getSchedulings')</h1>
{{ Form::open(['url' => 'scheduling/search', 'autocomplete' => 'off', 'class' =>'form-inline']) }}

<div class="form-group mb-2">
  {{ Form::label('channel', __('dpi.channel_name'), array('class' => 'mr-2')) }}
<div>
  <select name="channel">
    @foreach($channels as $channel)
      <option value="{{$channel->id}}"
            @if ($channel->id == $channelId)
                selected="selected"
            @endif
            >{{$channel->name}}</option>
    @endforeach
  </select>
</div>
</div>
<div class="form-group mx-sm-3 mb-2">
  {{ Form::label('init_date', __('dpi.init_date'), array('class' => 'mr-2')) }}
  {{ Form::text('init_date', null, ['class' => 'form-control', 'id' =>'sch_init_date']) }}
  {{ Form::hidden('screen', "index", ['class' => 'form-control', 'id' =>'screen']) }}
</div>
<button type="submit" class="btn btn-primary mb-2">@lang('dpi.search')</button>
{{ Form::close() }}

@if(isset($populatedWindows) && $populatedWindows->isNotEmpty())
  <?php  $lastInitDate = -1; ?>
@foreach ($populatedWindows as $key => $window)
    <?php
      $actualInitDate = Carbon\Carbon::parse($window->init_date)->copy()->startOfDay();
      $lastInitDatepr = Carbon\Carbon::parse($lastInitDate)->copy()->startOfDay();
    ?>
  @if ($lastInitDate == -1 || $actualInitDate->ne($lastInitDatepr))
<?php  $lastInitDate = $window->init_date; ?>
    {{ Form::open(['url' => 'scheduling/fileGeneration', 'autocomplete' => 'off', 'class' =>'form-inline mt-3']) }}
      {{ Form::hidden('schDate', Carbon\Carbon::parse($window->init_date)->toDateString(), ['class' => 'form-control', 'id' =>'schDate']) }}
      {{ Form::hidden('channelId', $channelId, ['class' => 'form-control', 'id' =>'channelId']) }}
    <button type="submit" class="btn btn-warning btn-lg btn-block">@lang('dpi.fileGeneration')</button>
      {{ Form::close() }}
  @endif
  <div class="text-center justify-content-center d-flex">
    <table class="table table-hover table-responsive table-condensed">
        <thead class="thead-dark">
            <tr>
                <th>Parseado</th>
                <th>@lang('dpi.window_init_date')</th>
                <th>@lang('dpi.window_duration')</th>
                <th>@lang('dpi.break_position_in_window')</th>
                <th>@lang('dpi.hoi')</th>
                <th>@lang('dpi.ad_pos_in_break')</th>
                <th>@lang('dpi.ad_name')</th>
                <th>@lang('dpi.ad_duration')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($window->SpotInsertion as $key => $spot_insertion)
              <tr>
                <td>{{ Carbon\Carbon::parse($window->init_date)->toDateString() }}</td>
                  <td>{{ $window->init_date }}</td>
                  <td>{{ $window->duration }}</td>
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
@endforeach
@elseif($schDate)
  <div class="alert alert-primary">No hay programaciones para la fecha escogida</div>
@endif
@stop
