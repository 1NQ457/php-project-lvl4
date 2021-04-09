@extends('layouts.app')

@section('content')
    <h1 class="mb-5">
        {{ __('interface.task_statuses.create') }}
    </h1>
    {{ Form::model($taskStatus, [
        'url' => route('task_statuses.store'),
        'class' => 'w-50'])
    }}
        @include('task_status.form')
        {{ Form::submit(__('interface.create'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection
