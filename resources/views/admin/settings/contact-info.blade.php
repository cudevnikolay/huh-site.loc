@extends('adminlte::page')

@section('title', 'Contact Info - Admin Panel | ' . config('app.name'))

@section('content_header')
    <h1>Contact Info</h1>
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
                {{ Form::open(['method' => 'post', 'action' => 'Admin\SettingsController@updetaCntactInfo', 'class' => 'form-horizontal']) }}
                <div class="box-body">
                    <div class="box-body">
                        @foreach($settingsList as $key => $settingVal)
                            <div class="form-group {{ $errors->has($key) ? 'has-error' : '' }}">
                                {{ Form::label($key, ucfirst($key), ['class' => 'col-md-2 col-sm-2 control-label']) }}
                                <div class="col-md-4 col-sm-10 col-xs-12">
                                    {{ Form::text($key, $settingVal, ['class' => 'form-control', 'placeholder' => ucfirst($key), 'maxlength' => 255]) }}
                                    @if ($errors->has($key))
                                        <span class="help-block">{{ $errors->first($key) }}</span>
                                    @endif
                                </div>
                            </div>
                            {{--<section class="group template-locale-block">
                                {{ Form::hidden($setting['key'] . "[key]", $setting) }}
                                <div class="form-group {{$errors->has("{$socialLink['alias']}.link") ? 'has-error' : ''}}">
                                    {{ Form::label($setting['key'], ucfirst($socialLink['alias']), ['class' => 'col-md-2 col-sm-2 control-label']) }}
                                    <div class="col-md-10 col-sm-10">
                                        {{ Form::text($socialLink['alias'] . "[link]", $socialLink['link'] != '' ? $socialLink['link'] : '', ['class' => 'form-control', 'placeholder' => 'Address']) }}
                                        @if($errors->has("{$socialLink['alias']}.link"))
                                            <span class="help-block">{{$errors->first("{$socialLink['alias']}.link")}}</span>
                                        @endif
                                    </div>
                                </div>
                            </section>--}}
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
