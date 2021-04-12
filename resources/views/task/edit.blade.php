@extends('layouts.app')

@section('content')
    <h1 class="mb-5">
        {{ __('interface.tasks.edit') }}
    </h1>
    {{ Form::model($task, [
    'url' => route('tasks.update', $task),
    'method' => 'PATCH',
    'class' => 'w-50'])
    }}
        @include('task.form')
        {{ Form::submit(__('interface.update'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection