<!-- First_name Form Input -->
<div class="form-group">
    {{ Form::label('first_name', 'First_name:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::text('first_name', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- Last_name Form Input -->
<div class="form-group">
    {{ Form::label('last_name', 'Last_name:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::text('last_name', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- Email Form Input -->
<div class="form-group">
    {{ Form::label('email', 'Email:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::text('email', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- Password Form Input -->
<div class="form-group">
    {{ Form::label('password', 'Password:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::password('password', ['class' => 'form-control']) }}
    </div>
</div>


<!-- Company Form Input -->
<div class="form-group">
    {{ Form::label('company', 'Company:', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
        {{ Form::select('company', ['36s' => '36S', 'emrill' => 'Emrill', 'chicago' => 'Chicago'], null, ['class' => 'form-control']) }}
    </div>
</div>

@if (count($groups))
    <div class="form-group">
        <label class="col-sm-3 control-label">Assigned groups<br/>
            <small>Selected groups on the right</small></label>

        <div class="col-sm-7">
            <select multiple="multiple" name="groups[]" class="form-control multi-select">
                @foreach ($groups as $group)
                <option value="{{ $group }}">{{ $group }}</option>
                @endforeach
                @if (isset($userGroups))
                @foreach ($userGroups as $group)
                <option value="{{ $group }}" selected>{{ $group }}</option>
                @endforeach
                @endif
            </select>
        </div>
    </div>
@endif

<div class="form-group">
    <label class="col-sm-3 control-label">Allowed permissions<br/>
        <small>Allowed permissions on the right</small></label>

    <div class="col-sm-7">
        <select multiple="multiple" name="permissions_allowed[]" class="form-control multi-select">
            @if (isset($allowedPermissionsDiff))
                @foreach ($allowedPermissionsDiff as $permission)
                    <option value="{{ $permission }}">{{ $permission }}</option>
                @endforeach
            @endif
            @if (isset($allowedPermissions))
                @foreach ($allowedPermissions as $permission)
                    <option value="{{ $permission }}" selected>{{ $permission }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Denied permissions<br/>
        <small>Denied permissions on the right</small></label>

    <div class="col-sm-7">
        <select multiple="multiple" name="permissions_denied[]" class="form-control multi-select">
            @if (isset($deniedPermissionsDiff))
                @foreach ($deniedPermissionsDiff as $permission)
                    <option value="{{ $permission }}">{{ $permission }}</option>
                @endforeach
            @endif
            @if (isset($deniedPermissions))
                @foreach ($deniedPermissions as $permission)
                    <option value="{{ $permission }}" selected>{{ $permission }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>

<!-- if creating new user -->

    <!-- Send_email Form Input -->
    <div class="form-group">
        {{ Form::label('send_email', $submit === 'Submit' ? 'Send welcome email:' : 'Resend Credentials', ['class' => 'col-sm-3 control-label']) }}
        <div class="col-sm-5">
            {{ Form::checkbox('send_email', true, false, ['class' => 'form-control']) }}
        </div>
    </div>



<!-- Buttons -->
<div class="form-group">
    {{ Form::label('', '', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-5">
<!-- Submit button -->
        {{ Form::submit(isset($submit)?$submit:'Submit', ['class' => 'form-control btn btn-primary']) }}
<!-- Cancel button -->
        {{ link_to_route('admin.users.index', 'Cancel', null, array('class'=>'form-control btn btn-warning')) }}
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
