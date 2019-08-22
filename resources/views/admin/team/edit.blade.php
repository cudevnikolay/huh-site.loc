@extends('adminlte::page')

@section('title', 'Edit Team Member - Admin Panel | ' . config('app.name'))

@section('content_header')
    <h1>Edit Team Member</h1>
@stop

@section('content')
    {{--@include('admin.errors')--}}
    <div class="row" style="margin: 0">
        <div class="col-xs-12 form-in-content">
            <div class="box box-exchanges">
                {!! Form::model($team, ['enctype' => 'multipart/form-data', 'method' => 'put',
                                        'route' => ['team.update', 'id' => $team->id],
                                        'class' => 'form-horizontal']) !!}
                    {{ Form::hidden('id', isset($team->id) ? $team->id : null) }}
                    @include('admin.team.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
