@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('interface.task_statuses.name') }}</h1>
    @auth
        <a href="{{ route('task_statuses.create') }}" class="btn btn-primary">{{ __('interface.task_statuses.create') }}</a>
    @endauth
    <table class="table mt-2">
        <thead>
            <tr>
                <th>{{ __('interface.id') }}</th>
                <th>{{ __('interface.name') }}</th>
                <th>{{ __('interface.created_at') }}</th>
                @auth
                    <th>{{ __('interface.actions') }}</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach($taskStatuses as $status)
                <tr>
                    <td>{{ $status->id }}</td>
                    <td>{{ $status->name }}</td>
                    <td>{{ $status->created_at->format('d.m.Y') }}</td>
                    @auth
                        <td>
                            <a href="{{ route('task_statuses.destroy', $status) }}" class="text-danger" data-confirm="{{ __('interface.are_you_sure') }}" data-method="delete" rel="nofollow">
                                {{ __('interface.destroy') }}
                            </a>
                            <a href="{{ route('task_statuses.edit', $status) }}">
                                {{ __('interface.edit') }}
                            </a>
                        </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
