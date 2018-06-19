@extends('dpi/index')
@section('content')
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ URL::to('windows') }}">@lang('dpi.windows')</a>
    </li>
    <li class="breadcrumb-item active">@lang('dpi.show_window'): {{ $window->id }}</li>
  </ol>
<div class="container">

    <div class="jumbotron text-center">
        <h2>{{ $window->id }}</h2>
        <p>
          <strong>@lang('dpi.channel_name'):</strong> {{ $window->channel->name }}<br>
          <strong>@lang('dpi.init_date'):</strong> {{ $window->init_date }}<br>
          <strong>@lang('dpi.duration'):</strong> {{ $window->duration }}
        </p>
    </div>

</div>
@stop
