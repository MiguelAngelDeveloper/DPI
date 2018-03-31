@extends('dpi/index')
@section('content')
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ URL::to('ads') }}">@lang('dpi.ads')</a>
    </li>
    <li class="breadcrumb-item active">@lang('dpi.show_ad'): {{ $ad->name }}</li>
  </ol>
<div class="container">

    <div class="jumbotron text-center">
        <h2>{{ $ad->name }}</h2>
        <p>
          <strong>@lang('dpi.duration'):</strong> {{ $ad->duration }}<br>
          <strong>@lang('dpi.tipo'):</strong> {{ $ad->tipo }}<br>
          <strong>@lang('dpi.code'):</strong> {{ $ad->code }}<br>
          <strong>@lang('dpi.announcer'):</strong> {{ $ad->announcer }}
        </p>
    </div>

</div>
@stop
