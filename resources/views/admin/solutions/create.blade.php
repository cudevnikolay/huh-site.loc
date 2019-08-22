@extends('adminlte::page')

@section('title', 'Create Solution - Admin Panel')

@section('content_header')
    <h1>Add Solution</h1>
@stop

@section('content')
    {{--@include('admin.errors')--}}
    <div class="row" style="margin: 0">
        <div class="col-xs-12 form-in-content">
            <div class="box box-exchanges">
                {!! Form::open([ 'class' => 'form-horizontal',
                            'enctype' => 'multipart/form-data',
                            'action' => 'Admin\SolutionsController@store']) !!}
                    @include('admin.solutions.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
