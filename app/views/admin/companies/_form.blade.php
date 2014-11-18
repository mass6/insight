
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
        {{ Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 2]) }}
    </div>
</div>

<!-- Address 1 -->
<h3>Address 1</h3>
<div class="form-group">
    {{ Form::label('address1_description', 'Description:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::text('address1_description', null, ['class' => 'form-control']) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('address1_body', 'Body:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::textarea('address1_body', null, ['class' => 'form-control', 'rows' => 6]) }}
    </div>
</div>

<!-- Address 2 -->
<h3>Address 2</h3>
<div class="form-group">
    {{ Form::label('address2_description', 'Description:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::text('address2_description', null, ['class' => 'form-control']) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('address2_body', 'Body:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::textarea('address2_body', null, ['class' => 'form-control', 'rows' => 6]) }}
    </div>
</div>

<!-- Address 3 -->
<h3>Address 3</h3>
<div class="form-group">
    {{ Form::label('address3_description', 'Description:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::text('address3_description', null, ['class' => 'form-control']) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('address3_body', 'Body:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::textarea('address3_body', null, ['class' => 'form-control', 'rows' => 6]) }}
    </div>
</div>

<!-- Address 4 -->
<h3>Address 4</h3>
<div class="form-group">
    {{ Form::label('address4_description', 'Description:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::text('address4_description', null, ['class' => 'form-control']) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('address4_body', 'Body:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::textarea('address4_body', null, ['class' => 'form-control', 'rows' => 6]) }}
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