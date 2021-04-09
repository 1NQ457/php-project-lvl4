@extends('layouts.app')

@section('content')
    <h1 class="mb-5">
        {{ __('interface.task_statuses.edit') }}
    </h1>
    <div>
        {{ Form::model($taskStatus, ['url' => route('task_statuses.update', $taskStatus), 'method' => 'PATCH']) }}
            @include('task_status.form')
            {{ Form::submit(__('interface.update'), ['class' => 'btn btn-success']) }}
        {{ Form::close() }}
    </div>
@endsection