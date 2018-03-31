@extends('dpi/index')
@section('content')
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ URL::to('ads') }}">@lang('dpi.ads')</a>
    </li>
    <li class="breadcrumb-item active">@lang('dpi.insert')</li>
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
    <h1 class="">@lang('dpi.insert')</h1>
{{ Form::open(['url' => 'ads']) }}
    <div class="form-group mt-3">
    {{ Form::label('name', 'Nombre del Anuncio') }}
    {{ Form::text('name', null, ['class' => 'form-control', 'maxlength' => 100]) }}
    </div>
    <div class="form-group">
     <div class="form-row">
       <div class="col">
       {{ Form::label('duration', 'Duración') }}
       {{ Form::text('duration', null, ['class' => 'form-control',  'id' => 'duration_ad']) }}
       </div>
       <div class="col">
      {{ Form::label('tipo', 'Tipo') }}
      {{ Form::text('tipo', null, ['class' => 'form-control',  'maxlength' => 100]) }}
      </div>
    </div>
  </div>
  <div class="form-group">
   <div class="form-row">
     <div class="col">
    {{ Form::label('code', 'Código del Anuncio') }}
    {{ Form::text('code', null, ['class' => 'form-control',  'maxlength' => 11]) }}
    </div>
    <div class="col">
    {{ Form::label('announcer', 'Anunciante') }}
    {{ Form::text('announcer', null, ['class' => 'form-control',  'maxlength' => 20]) }}
    </div>
  </div>
</div>
  <div class="form-group">
    <button type="submit" class="btn btn-info">
      @lang('dpi.insert')
    </button>
</div>
</div>
{{ Form::close() }}
</div>
@stop
