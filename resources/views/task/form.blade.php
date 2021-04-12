@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="form-group">
    {{ Form::label('name', __('interface.name')) }}
    {{ Form::text('name', $task->name, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('description', __('interface.description')) }}
    {{ Form::textarea('description', $task->description, ['class' => 'form-control', 'rows' => '10']) }}
</div>
<div class="form-group">
    {{ Form::label('status_id', __('interface.status')) }}
    {{ Form::select('status_id', $taskStatuses, null, ['class' => 'form-control', 'placeholder' => '---------']) }}
</div>
<div class="form-group">
    {{ Form::label('assigned_to_id', __('interface.performer')) }}
    {{ Form::select('assigned_to_id', $users, null, ['class' => 'form-control', 'placeholder' => '---------']) }}
</div>
