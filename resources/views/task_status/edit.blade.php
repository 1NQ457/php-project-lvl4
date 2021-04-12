@extends('layouts.app')

@section('content')
    <h1 class="mb-5">
        {{ __('interface.task_statuses.edit') }}
    </h1>
    {{ Form::model($taskStatus, [
        'url' => route('task_statuses.update', $taskStatus),
        'class' => 'w-50',
        'method' => 'PATCH'])
    }}
        @include('task_status.form')
        {{ Form::submit(__('interface.update'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection