@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('interface.tasks.name') }}</h1>
    <div class="d-flex">
    <div>
        {{ Form::open(['url' => route('tasks.index'), 'method' => 'GET', 'class' => 'form-inline']) }}
            {{ Form::select('filter[status_id]', $taskStatuses, session('filter')['status_id'] ?? null, ['class' => 'form-control mr-2', 'placeholder' => __('interface.status')]) }}
            {{ Form::select('filter[created_by_id]', $users, session('filter')['created_by_id'] ?? null, ['class' => 'form-control mr-2', 'placeholder' => __('interface.creator')]) }}
            {{ Form::select('filter[assigned_to_id]', $users, session('filter')['assigned_to_id'] ?? null, ['class' => 'form-control mr-2', 'placeholder' => __('interface.performer')]) }}
            {{ Form::submit(__('interface.apply'), ['class' => 'btn btn-outline-primary']) }}
        {{ Form::close() }}
    </div>
    @auth
        <a href="{{ route('tasks.create') }}" class="btn btn-primary ml-auto">{{ __('interface.tasks.create') }}</a>
    @endauth
</div>
    <table class="table mt-2">
        <thead>
            <tr>
                <th>{{ __('interface.id') }}</th>
                <th>{{ __('interface.status') }}</th>
                <th>{{ __('interface.name') }}</th>
                <th>{{ __('interface.creator') }}</th>
                <th>{{ __('interface.performer') }}</th>
                <th>{{ __('interface.created_at') }}</th>
                @auth
                    <th>{{ __('interface.actions') }}</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ optional($task->status)->name }}</td>
                    <td><a href="{{route('tasks.show', $task)}}">{{$task->name}}</a></td>
                    <td>{{ $task->creator->name }}</td>
                    <td>{{optional($task->performer)->name}}</td>
                    <td>{{ $task->created_at->format('d.m.Y') }}</td>
                    @auth
                        <td>
                            @if($task->created_by_id == Auth::id())
                                <a href="{{route('tasks.destroy', $task)}}"
                                    data-confirm="{{ __('messages.alert.confirm') }}"
                                    data-method="delete"
                                    rel="nofollow"
                                    class="text-danger">
                                    {{ __('interface.destroy') }}
                                </a>
                            @endif
                            <a href="{{ route('tasks.edit', $task) }}">
                                {{ __('interface.edit') }}
                            </a>
                        </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
