@extends($layout)

@section('content')

<h1>Companies</h1>

    <ul>
        <li>currentUser - {{$currentUser}}</li>
        <li>layout - {{$layout}}</li>
        <li>layoutPath - {{$layoutPath }}</li>
        <li>defaultLayout - {{ $defaultLayout }}</li>
    </ul>
    <p>{{ link_to_route('admin.companies.create', 'Add new company', null, ['class' => 'btn btn-primary']) }}</p>
    @if ($companies->count())
    <table  id="sample" class="display table table-striped table-bordered">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Type</th>
            <th>Note</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($companies as $company)
        <tr>
            <td>{{ $company->id }}</td>
            <td>{{ $company->name }}</td>
            <td>{{ $company->type }}</td>
            <td>{{ $company->notes }}</td>
            <td>{{ link_to_route('admin.companies.edit', 'Edit', array($company->id), array('class' => 'btn btn-info pull-left')) }}
                {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.companies.destroy', $company->id))) }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger', 'Onclick'=>'return confirm("Are you sure you want to delete this company?")')) }}
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        {{ $companies->links() }}
    </div>
    @endif

@stop