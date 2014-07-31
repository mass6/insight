<h2>Change Password</h2>

{{ Form::open( ['route' => ['password.update', $currentUser->id], 'method' => 'PATCH'] ) }}

    @if (isset($errors))
        @if ( count($errors) )
            <div class="errors alert alert-danger">
                @foreach ($errors->all('<li>:message</li>') as $message)
                    {{ $message }}
                @endforeach
            </div>
        @endif
    @endif

    <!-- New Password Form Input -->
    <div class="form-group">
        {{ Form::label('password', 'New Password:') }}
        {{ Form::password('password', ['class' => 'form-control']) }}
    </div>

    <!-- New Password_confirmation Form Input -->
    <div class="form-group">
        {{ Form::label('password_confirmation', 'Confirm New Password:') }}
        {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
    </div>
    <br />

    <div class="form-group">
        {{ Form::submit( 'Submit', ['class' => 'btn btn-primary']) }} {{ link_to_route('profiles.show', 'Cancel', $user->id, array('class'=>'btn btn-warning')) }}
    </div>

{{ Form::close() }}