@extends('dpi/index')
@section('content')
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ URL::to('windows') }}">@lang('dpi.windows')</a>
    </li>
    <li class="breadcrumb-item active">@lang('dpi.show_break'): {{ $break->id }}</li>
  </ol>
<div class="container">

    <div class="jumbotron text-center">
        <h2>{{ $break->id }}</h2>
        <p>
          <strong>@lang('dpi.channel_name'):</strong> {{ $break->channel->name }}<br>
          <strong>@lang('dpi.init_date'):</strong> {{ $break->init_date }}<br>
          <strong>@lang('dpi.duration'):</strong> {{ $break->duration }}
        </p>
    </div>

</div>
@stop
