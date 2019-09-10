<div class="box-body">
    <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
        {{ Form::label('title', 'Title (EN)', ['class' => 'col-md-2 col-sm-2 col-xs-5 control-label']) }}
        <div class="col-md-4 col-sm-10 col-xs-12">
            {{ Form::text('title', isset($solution->title) ? $solution->title : null, ['class' => 'form-control', 'placeholder' => 'Title']) }}
            @if ($errors->has('title'))
                <span class="help-block">{{ $errors->first('title') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group {{$errors->has('type') ? 'has-error' : ''}}">
        {{ Form::label('type', 'Type', ['class' => 'col-md-2 col-sm-2 col-xs-5 control-label']) }}
        <div class="col-md-4 col-sm-10 col-xs-12">
            {!! Form::select('type', $solutionTypes, isset($solution->type) ? $solution->type : null, ['class' => 'form-control']) !!}
            @if ($errors->has('type'))
                <span class="help-block">{{ $errors->first('type') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group {{$errors->has('text') ? 'has-error' : ''}}">
        {{ Form::label('text', 'Text (EN)', ['class' => 'col-md-2 col-sm-2 col-xs-5 control-label']) }}
        <div class="col-md-4 col-sm-10 col-xs-12">
            {{ Form::text('text', isset($solution->text) ? $solution->text : null, ['class' => 'form-control', 'placeholder' => 'Text']) }}
            @if ($errors->has('text'))
                <span class="help-block">{{ $errors->first('text') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('', 'Active', ['class' => 'col-md-2 col-sm-2 control-label status-form-label']) }}
        <div class="col-md-4 col-sm-10">
            <label class="switch">
                @if (!isset($solution->enabled) || $solution->enabled == 1)
                    {{ Form::checkbox('enabled',null, true) }}
                @else ($solution->enabled == 0)
                    {{ Form::checkbox('enabled',null, false) }}
                @endif
                <span class="slider round"></span>
            </label>
        </div>
    </div>
    @if (isset($solution->id) && $solution->image)
        <div class="form-group">
            {{ Form::label('image', 'Current Image', ['class' => 'col-md-2 col-sm-2 col-xs-5 control-label']) }}
           <div class="col-md-10 col-sm-10 col-xs-12">
               <img src="{{ \App\Helpers\ImageHelper::getUrl($solution->image, 'solution') }}"  style="height: 68px; border: dashed 1px #ccc;">
           </div>
        </div>
    @endif
    <div class="form-group" >
        {{ Form::label('image', 'Image', ['class' => 'col-md-2 col-sm-2 col-xs-5 control-label ' . ($errors->has('image') ? 'has-error' : '')]) }}
        <div class="col-md-4 col-sm-10 col-xs-12">
            <div class="row">
                <div class="col-md-12">
                    {{ Form::file('image', [
                        'class' => 'filestyle',
                        'data-btnClass' => 'btn-success',
                        'data-buttonBefore' => 'true',
                        'data-input'=> 'true',
                        'data-text' => '<i class="fa fa-cloud-upload"></i> Upload Image',
                        'style' => 'display: none'
                    ]) }}
                    <p class="help-block {{ $errors->has('image') ? 'has-error' : '' }}">{{ $errors->first('image') }}</p>
                    <p class="help-block text-sm">
                        File format: PNG, JPG, JPEG (Recommended image size: 350x425; Maximum file size: 1MB).
                    </p>
                </div>
            </div>
        </div>
    </div>
    @if (!empty($translationLanguages))
        <h4 class="page-header">Translations</h4>
        @foreach($translationLanguages as $translationLanguage)
            <section class="group template-locale-block">
                <div class="form-group">
                    {{ Form::label('translation_title', "Title - " . $translationLanguage['name'], ['class' => 'col-md-2 col-sm-2 control-label']) }}
                    <div class="col-md-10 col-sm-10">
                        {{ Form::text("translation[{$translationLanguage['locale']}][title]", (isset($solution->id) && $solutionTranslation = $solution->getTranslationByLocale($translationLanguage['locale'])) ? $solutionTranslation->title : '', ['class' => 'form-control', 'placeholder' => 'Title']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('translation_text', "Text - " . $translationLanguage['name'], ['class' => 'col-md-2 col-sm-2 control-label']) }}
                    <div class="col-md-10 col-sm-10">
                        {{ Form::text("translation[{$translationLanguage['locale']}][text]", (isset($solution->id) && $solutionTranslation = $solution->getTranslationByLocale($translationLanguage['locale'])) ? $solutionTranslation->text : '', ['class' => 'form-control', 'placeholder' => 'Text']) }}
                    </div>
                </div>
            </section>
        @endforeach
    @endif
</div>
<div class="box-footer">
    <div class="row">
        <div class="col-sm-offset-2 col-sm-10">
            {{ Form::button( 'Save Solution', ['type' => 'submit', 'class' => 'btn btn-success save-solution-button']) }}
            <a class="btn btn-default" href="{{ route('solutions.index') }}">Cancel</a>
        </div>
    </div>
</div>
