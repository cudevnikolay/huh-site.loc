@extends('adminlte::page')

@section('title', 'Edit Quote - Admin Panel | ' . config('app.name'))

@section('content_header')
    <h1>Edit Quote</h1>
@stop

@section('content')
    {{--@include('admin.errors')--}}
    <div class="row" style="margin: 0">
        <div class="col-xs-12 form-in-content">
            <div class="box box-exchanges">
                {!! Form::model($quote, ['enctype' => 'multipart/form-data', 'method' => 'put',
                                        'route' => ['quotes.update', 'id' => $quote->id],
                                        'class' => 'form-horizontal']) !!}
                    {{ Form::hidden('id', isset($quote->id) ? $quote->id : null) }}
                    @include('admin.quotes.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
