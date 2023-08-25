<!--begin: Datatable-->
<table class="table table-separate table-head-custom" id="kt_datatable">
    <thead>
    <tr>
        <th>title</th>
        <th>desc</th>
        <th>user</th>
            <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tasks as $task)
        <tr>
            <td>{{ $task->title }}</td>
            <td>{{ $task->description }}</td>
            <td>{{ $task?->user?->name }}</td>
                <td>
                        <div class='btn-group'>
                                <a href="{{ route('tasks.edit', [$task->id]) }}"
                                   class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                                {!! Form::open(['route' => ['tasks.destroy', $task->id], 'method'
                                => 'delete', 'class' =>'d-inline-block']) !!}
                                {!! Form::button('<i class="fa fa-trash"></i>',
                                    ['type' => 'submit', 'class' => 'btn btn-danger btn-xs',
                                    'onclick' => "return confirm('Are you sure you woant to delete this user?')"]) !!}
                                {!! Form::close() !!}
                        </div>
                </td>
        </tr>
    @endforeach
    </tbody>
</table>
