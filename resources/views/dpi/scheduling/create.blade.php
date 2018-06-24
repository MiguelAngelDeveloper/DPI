@extends('dpi/index')
@section('content')
  <style>
.break-collapse:hover {
  text-decoration: none;
}
.break-collapse:link {
  color: black;
}
  </style>
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ URL::to('scheduling') }}">@lang('dpi.scheduling')</a>
    </li>
    <li class="breadcrumb-item active">@lang('dpi.newScheduling')</li>
  </ol>
<?php $channelId = Session::get('channel');?>
  <!-- if there are creation errors, they will show here -->
  @if($errors->all())
    <div class="alert alert-danger">
    @foreach ($errors->all() as $key => $error)
      <div>{{$error}}</div>
    @endforeach
    </div>
  @endif
    <h1 class="">@lang('dpi.newScheduling')</h1>
{{ Form::open(['url' => 'scheduling/search', 'method' => 'POST', 'autocomplete' => 'off', 'class' =>'form-inline']) }}

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
</div>
<button type="submit" class="btn btn-primary mb-2">@lang('dpi.search')</button>
{{ Form::close() }}
@if(isset($freeWindows) && $freeWindows->isNotEmpty())
  <h5>@lang('dpi.freeWindows')</h5>
  @foreach ($freeWindows as $key => $window)
      <div class="card d-flex flex-wrap w-75" id="window{{$window->id}}">
        <div class="card-header">
          <a class="break-collapse collapsed ml-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="breaksw{{$window->id}}" href="#breaksw{{$window->id}}">
          <span>@lang('dpi.init_date'): {{ $window->init_date }}</span>
          <span>@lang('dpi.duration'): {{ $window->duration }}</span>
          </a>
          <span class="pull-right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalScheduling{{$window->id}}">
              @lang('dpi.insertNewBreak')
            </button>
          </span>
        </div>
        <div class="collapse" id="breaksw{{$window->id}}">
        <ul class="list-group list-group-flush collapse">
        </ul>
      </div>
    </div>

      <!-- Modal -->
    @include('dpi.scheduling.modal', ['window' => $window, 'spots' => $spots])

  @endforeach
@endif
@if(isset($populatedWindows) && $populatedWindows->isNotEmpty())
  <h5>@lang('dpi.scheduledWindows')</h5>
    <div id="acordeon">
          @foreach ($populatedWindows as $key => $window)
            @if($window->SpotInsertion->isNotEmpty())
            <div class="card d-flex flex-wrap w-75" id="window{{$window->id}}">
              <div class="card-header">
              <span>@lang('dpi.init_date'): {{ $window->init_date }}</span>
              <span>@lang('dpi.duration'): {{ $window->duration }}</span>
                <span class="pull-right">
                  <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modalScheduling{{$window->id}}">
                    @lang('dpi.insertNewBreak')
                  </button>
                  <button class="btn btn-light break-collapse collapsed ml-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="breaksw{{$window->id}}" data-target="#breaksw{{$window->id}}">
                    <i class="fa fa-fw fa-angle-double-down"></i>
                </button>
                </span>
              </div>
              <div class="collapse" id="breaksw{{ $window->id }}">
              <ul class="list-group list-group-flush collapse">
                @foreach ($window->SpotInsertion as $key => $SpotInsertion)
                  <li class="list-group-item">
                    <dl class="dl-horizontal">
                      <dt>@lang('dpi.break_position_in_window')</dt><dd>{{ $SpotInsertion->break_position_in_window }}</dd>
                      <dt>@lang('dpi.hoi')</dt><dd>{{ $SpotInsertion->break->optimal_insertion_date }}</dd>
                      <dt>@lang('dpi.ad_pos_in_break')</dt><dd>{{ $SpotInsertion->ad_pos_in_break }}</dd>
                      <dt>@lang('dpi.ad_name')</dt><dd>{{ $SpotInsertion->ad->name }}</dd>
                      <dt>@lang('dpi.ad_duration')</dt><dd>{{ $SpotInsertion->ad->duration }}</dd>
                    </dl>
                  </li>
                @endforeach
              </ul>
            </div>
          </div>

        @include('dpi.scheduling.modal', ['window' => $window, 'spots' => $spots])
        @endif
        @endforeach
      </div>
@endif
@stop
