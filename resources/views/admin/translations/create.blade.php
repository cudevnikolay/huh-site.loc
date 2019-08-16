@extends('adminlte::page')

@section('title', 'Add Language - Admin Panel | ' . config('app.name'))

@section('content_header')
    <h1>Add Language</h1>
@stop

@section('content')
    <div class="row" style="margin: 0">
        <div class="col-xs-12 form-in-content">
            {!! Form::open(['method' => 'put', 'route' => ['language.store'], 'enctype' => "multipart/form-data", 'class' => 'form-horizontal language-form']) !!}
                @include('admin.translations.form')
            {!! Form::close() !!}
        </div>
    </div>
@stop