<table class="table table-responsive" id="acids-table">
    <thead>
        <tr>
            <th>Data Id</th>
        <th>Level</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($acids as $acid)
        <tr>
            <td>{!! $acid->data_id !!}</td>
            <td>{!! $acid->level !!}</td>
            <td>
                {!! Form::open(['route' => ['acids.destroy', $acid->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('acids.show', [$acid->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('acids.edit', [$acid->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>