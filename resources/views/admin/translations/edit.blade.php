@extends('adminlte::page')

@section('title', 'Edit Language - Admin Panel | ' . config('app.name'))

@section('content_header')
    <h1>Edit Language</h1>
@stop

@section('content')
    @include('admin.notifications')
    <div class="row" style="margin: 0">
        <div class="col-xs-12 form-in-content">
            {!! Form::model($data['language'], ['method' => 'put', 'route' => ['language.update', 'id' => $data['language']->id], 'enctype' => "multipart/form-data", 'class' => 'form-horizontal language-form']) !!}
                @include('admin.translations.form')
            {!! Form::close() !!}
        </div>
    </div>
@stop

