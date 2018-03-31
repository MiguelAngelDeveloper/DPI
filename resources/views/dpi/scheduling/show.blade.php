@extends('dpi/index')
@section('content')
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ URL::to('channels') }}">@lang('dpi.channels')</a>
    </li>
    <li class="breadcrumb-item active">@lang('dpi.show_channel'): {{ $channel->name }}</li>
  </ol>
<div class="container">

    <div class="jumbotron text-center">
        <h2>{{ $channel->name }}</h2>
        <p>
            <strong>@lang('dpi.code'):</strong> {{ $channel->code }}<br>
            <strong>@lang('dpi.zone'):</strong> {{ $channel->zone }}
        </p>
    </div>

</div>
@stop
