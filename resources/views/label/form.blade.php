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
    {{ Form::text('name', $label->name, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('description', __('interface.description')) }}
    {{ Form::textarea('description', $label->description, ['class' => 'form-control', 'rows' => '10']) }}
</div>
