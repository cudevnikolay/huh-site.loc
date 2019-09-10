<div class="box-body">
    <div class="form-group {{$errors->has('locale') ? 'has-error' : ''}}">
        {{ Form::label('locale', 'Locale', ['class' => 'col-md-2 col-sm-2 col-xs-5 control-label']) }}
        <div class="col-md-4 col-sm-10 col-xs-12">
            {!! Form::select('locale', $localeTypes, isset($quote->locale) ? $quote->locale : null, ['class' => 'form-control']) !!}
            @if ($errors->has('locale'))
                <span class="help-block">{{ $errors->first('locale') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
        {{ Form::label('title', 'Title', ['class' => 'col-md-2 col-sm-2 col-xs-5 control-label']) }}
        <div class="col-md-4 col-sm-10 col-xs-12">
            {{ Form::text('title', isset($quote->title) ? $quote->title : null, ['class' => 'form-control', 'placeholder' => 'Title']) }}
            @if ($errors->has('title'))
                <span class="help-block">{{ $errors->first('title') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
        {{ Form::label('text', 'Text', ['class' => 'col-md-2 col-sm-2 control-label']) }}
        <div class="col-md-4 col-sm-10 col-xs-12">
            {{ Form::textarea('text', isset($quote->text) ? $quote->text : null, ['class' => 'form-control', 'placeholder' => 'Text', 'maxlength' => 255]) }}
            @if ($errors->has('text'))
                <span class="help-block">{{ $errors->first('text') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group {{ $errors->has('author') ? 'has-error' : '' }}">
        {{ Form::label('author', 'Author', ['class' => 'col-md-2 col-sm-2 control-label']) }}
        <div class="col-md-4 col-sm-10 col-xs-12">
            {{ Form::text('author', isset($quote->author) ? $quote->author : null, ['class' => 'form-control', 'placeholder' => 'Author', 'maxlength' => 255]) }}
            @if ($errors->has('author'))
                <span class="help-block">{{ $errors->first('author') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('', 'Active', ['class' => 'col-md-2 col-sm-2 control-label status-form-label']) }}
        <div class="col-md-4 col-sm-10">
            <label class="switch">
                @if (!isset($quote->enabled) || $quote->enabled == 1)
                    {{ Form::checkbox('enabled',null, true) }}
                @else ($quote->enabled == 0)
                    {{ Form::checkbox('enabled',null, false) }}
                @endif
                <span class="slider round"></span>
            </label>
        </div>
    </div>
</div>
<div class="box-footer">
    <div class="row">
        <div class="col-sm-offset-2 col-sm-10">
            {{ Form::button( 'Save Quote', ['type' => 'submit', 'class' => 'btn btn-success save-quotes-button']) }}
            <a class="btn btn-default" href="{{ route('quotes.index') }}">Cancel</a>
        </div>
    </div>
</div>
