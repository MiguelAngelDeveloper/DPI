@extends('dpi/index')
@section('content')
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ URL::to('reports/create') }}">@lang('dpi.reports')</a>
    </li>
    <li class="breadcrumb-item active">@lang('dpi.verifile')</li>
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
    <h1 class="">@lang('dpi.verifile')</h1>
{{ Form::open(['url' => 'reports', 'autocomplete' => 'off', 'files' => true]) }}

    <div class="form-group mt-3">
      {{ csrf_field() }}
      {{ Form::file('verificationfile', null, ['class' => 'form-control']) }}
    </div>
  <div class="form-group">
    <button type="submit" class="btn btn-info">
      @lang('dpi.verify')
    </button>
</div>
</div>
{{ Form::close() }}
</div>
@stop
