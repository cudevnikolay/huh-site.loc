@extends('adminlte::page')

@section('title', 'Social Links - Admin Panel | ' . config('app.name'))

@section('content_header')
    <h1>Social Links</h1>
@stop

@section('content')
    @include('admin.notifications')
    @if (Session::has('notifications'))
        @php
            $notifications = Session::get('notifications');
        @endphp
    @endif
    <div class="row" style="margin: 0">
        <div class="col-xs-12 form-in-content">
            <div class="box box-default">
                {{ Form::open(['method' => 'post', 'action' => 'Admin\SocialLinksController@update', 'class' => 'form-horizontal']) }}
                <div class="box-body">
                    <div class="box-body">
                        @foreach($socialLinks as $socialLink)
                            <section class="group template-locale-block">
                                {{ Form::hidden($socialLink['alias'] . "[alias]", $socialLink['alias']) }}
                                <div class="form-group {{$errors->has("{$socialLink['alias']}.link") ? 'has-error' : ''}}">
                                    {{ Form::label('privacy_policy', ucfirst($socialLink['alias']), ['class' => 'col-md-2 col-sm-2 control-label']) }}
                                    <div class="col-md-10 col-sm-10">
                                        {{ Form::text($socialLink['alias'] . "[link]", $socialLink['link'] != '' ? $socialLink['link'] : '', ['class' => 'form-control', 'placeholder' => 'Address']) }}
                                        @if($errors->has("{$socialLink['alias']}.link"))
                                            <span class="help-block">{{$errors->first("{$socialLink['alias']}.link")}}</span>
                                        @endif
                                    </div>
                                </div>
                            </section>
                        @endforeach
                    </div>
                </div>
                <div class="box-footer">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-offset-2 col-sm-10">
                                {{ Form::button(
                                'Save Changes',
                                ['type' => 'submit', 'class' => 'btn btn-success save-button', 'id' => 'save-settings-button']
                            ) }}
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>

        </div>
    </div>
@stop
