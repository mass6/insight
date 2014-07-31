<!-- Permission Name Form Input -->
<div class="form-group">
    {{ Form::label('name', 'name:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- Submit button -->
<div class="form-group">
    {{ Form::label('', '', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::submit(isset($submit)?$submit:'Submit', ['class' => 'form-control btn btn-primary']) }}
    </div>
</div>

<!-- Cancel button -->
<div class="form-group">
    {{ Form::label('', '', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ link_to_route('admin.permissions.index', 'Cancel', null, array('class'=>'form-control btn btn-warning')) }}
    </div>
</div>