@extends('layouts.app')

@section('content')
    <h1 class="mb-5">
        {{ __('interface.tasks.create') }}
    </h1>
    {{ Form::model($task, [
        'url' => route('tasks.store'),
        'class' => 'w-50'])
    }}
        @include('task.form')
        {{ Form::submit(__('interface.create'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection