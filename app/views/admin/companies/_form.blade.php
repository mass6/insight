
<!-- Company Name Form Input -->
<div class="form-group">
    {{ Form::label('name', 'name:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>

<!-- Company Type Form Input -->
<div class="form-group">
    {{ Form::label('name', 'type:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::text('type', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>

<!-- Notes Form Input -->
<div class="form-group">
    {{ Form::label('name', 'notes:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 6]) }}
    </div>
</div>

<!-- Buttons -->
<div class="form-group">
    {{ Form::label('', '', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        <!-- Submit button -->
        {{ Form::submit(isset($submit)?$submit:'Submit', ['class' => 'form-control btn btn-primary']) }}
        <!-- Cancel button -->
        {{ link_to_route('admin.companies.index', 'Cancel', null, array('class'=>'form-control btn btn-warning')) }}
    </div>
</div>


<!-- Bottom Scripts -->
<script src="{{ URL::asset('js/gsap/main-gsap.js') }}"></script>
<script src="{{ URL::asset('js/joinable.js') }}"></script>
<script src="{{ URL::asset('js/resizeable.js') }}"></script>
<script src="{{ URL::asset('js/neon-api.js') }}"></script>
<script src="{{ URL::asset('js/jquery.multi-select.js') }}"></script>
<script src="{{ URL::asset('js/icheck/icheck.min.js') }}"></script>
<script src="{{ URL::asset('js/neon-custom.js') }}"></script>