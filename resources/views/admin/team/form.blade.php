<div class="box-body">
    <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
        {{ Form::label('name', 'Name', ['class' => 'col-md-2 col-sm-2 col-xs-5 control-label']) }}
        <div class="col-md-4 col-sm-10 col-xs-12">
            {{ Form::text('name', isset($team->name) ? $team->name : null, ['class' => 'form-control', 'placeholder' => 'Name']) }}
            @if ($errors->has('name'))
                <span class="help-block">{{ $errors->first('name') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group {{ $errors->has('position') ? 'has-error' : '' }}">
        {{ Form::label('position', 'Position', ['class' => 'col-md-2 col-sm-2 control-label']) }}
        <div class="col-md-4 col-sm-10 col-xs-12">
            {{ Form::text('position', isset($team->alt) ? $team->alt : null, ['class' => 'form-control', 'placeholder' => 'Position', 'maxlength' => 255]) }}
            @if ($errors->has('position'))
                <span class="help-block">{{ $errors->first('position') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('', 'Active', ['class' => 'col-md-2 col-sm-2 control-label status-form-label']) }}
        <div class="col-md-4 col-sm-10">
            <label class="switch">
                @if (!isset($team->enabled) || $team->enabled == 1)
                    {{ Form::checkbox('enabled',null, true) }}
                @else ($team->enabled == 0)
                    {{ Form::checkbox('enabled',null, false) }}
                @endif
                <span class="slider round"></span>
            </label>
        </div>
    </div>
    @if (isset($team->id) && $team->image)
        <div class="form-group">
            {{ Form::label('image', 'Current Image', ['class' => 'col-md-2 col-sm-2 col-xs-5 control-label']) }}
           <div class="col-md-10 col-sm-10 col-xs-12">
               <img src="{{ \App\Helpers\ImageHelper::getUrl($team->image, 'team') }}"  style="height: 68px; border: dashed 1px #ccc;">
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
                        File format: PNG, JPG, JPEG (Recommended image size: 263x320; Maximum file size: 1MB).
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="box-footer">
    <div class="row">
        <div class="col-sm-offset-2 col-sm-10">
            {{ Form::button( 'Save Team Member', ['type' => 'submit', 'class' => 'btn btn-success save-team-button']) }}
            <a class="btn btn-default" href="{{ route('team.index') }}">Cancel</a>
        </div>
    </div>
</div>
