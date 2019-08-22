@extends('adminlte::page')

@section('title', 'Edit Solution - Admin Panel | ' . config('app.name'))

@section('content_header')
    <h1>Edit Solution</h1>
@stop

@section('content')
    {{--@include('admin.errors')--}}
    <div class="row" style="margin: 0">
        <div class="col-xs-12 form-in-content">
            <div class="box box-exchanges">
                {!! Form::model($solution, ['enctype' => 'multipart/form-data', 'method' => 'put',
                                        'route' => ['solutions.update', 'id' => $solution->id],
                                        'class' => 'form-horizontal']) !!}
                    {{ Form::hidden('id', isset($solution->id) ? $solution->id : null) }}
                    @include('admin.solutions.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
