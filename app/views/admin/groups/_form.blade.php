
<!-- Group Name Form Input -->
<div class="form-group">
    {{ Form::label('name', 'name:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
</div>



@if (count($permissions))
<div class="form-group">
    <label class="col-sm-3 control-label">Allowed permissions<br/>
        <small>Selected Permissions on the right</small></label>

    <div class="col-sm-9">
        <select multiple="multiple" name="permissions[]" class="form-control multi-select">
            @foreach ($permissions as $permission)
                <option value="{{ $permission }}">{{ $permission }}</option>
            @endforeach
            @if (isset($groupPermissions))
                @foreach ($groupPermissions as $permission)
                    <option value="{{ $permission }}" selected>{{ $permission }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>

@endif

<!-- Buttons -->
<div class="form-group">
    {{ Form::label('', '', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        <!-- Submit button -->
        {{ Form::submit(isset($submit)?$submit:'Submit', ['class' => 'form-control btn btn-primary']) }}
        <!-- Cancel button -->
        {{ link_to_route('admin.groups.index', 'Cancel', null, array('class'=>'form-control btn btn-warning')) }}
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