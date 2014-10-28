@extends($layout)

@section('content')

<h1>System Settings</h1>

<br/>

<div class="row">
{{ Form::open(['route' => ['admin.settings.update', 'notifications'], 'class' => 'form-horizontal form-groups-bordered validate', 'method' => 'patch', 'role' => 'form']) }}

	<div class="row">
		<div class="col-md-12">

			<div class="panel panel-primary" data-collapsed="0">

				<div class="panel-heading">
					<div class="panel-title">
						System Notifications
					</div>

					<div class="panel-options">
						<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
						<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					</div>
				</div>

				<div class="panel-body">

					<div class="form-group">
                        <label class="col-sm-3 control-label">Send portal data updates?</label>

                        <div class="col-sm-5">
                            <div class="make-switch" data-on="success" data-off="warning">
                                {{ Form::checkbox('portal-data-update-notifications', 'on', $settings['notifications']['portal-data-update-notifications'] == 'on' ? true : false) }}
                            </div>
                        </div>
                    </div>

				</div>

			</div>

		</div>
	</div>

	<div class="form-group default-padding">
		{{ Form::submit(isset($submit)?$submit:'Save Changes', ['class' => 'btn btn-primary']) }}
		 <!-- Reset button -->
        {{ link_to_route('admin.settings.index', 'Reset', null, array('type' => 'reset', 'class'=>'btn btn-default')) }}
	</div>

</form>
</div>

<script src="{{ URL::asset('js/bootstrap-switch.min.js') }}"></script>
@stop