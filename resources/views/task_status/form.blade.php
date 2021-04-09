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
    {{ Form::text('name', $taskStatus->name, ['class' => 'form-control']) }}
</div>
