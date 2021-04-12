@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('interface.labels.name') }}</h1>
    @auth
        <a href="{{ route('labels.create') }}" class="btn btn-primary">{{ __('interface.labels.create') }}</a>
    @endauth
    <table class="table mt-2">
        <thead>
            <tr>
                <th>{{ __('interface.id') }}</th>
                <th>{{ __('interface.name') }}</th>
                <th>{{ __('interface.description') }}</th>
                <th>{{ __('interface.created_at') }}</th>
                @auth
                    <th>{{ __('interface.actions') }}</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach($labels as $label)
                <tr>
                    <td>{{ $label->id }}</td>
                    <td>{{ $label->name }}</td>
                    <td>{{ $label->description }}</td>
                    <td>{{ $label->created_at->format('d.m.Y') }}</td>
                    @auth
                        <td>
                            <a href="{{ route('labels.destroy', $label) }}" class="text-danger" data-confirm="{{ __('interface.are_you_sure') }}" data-method="delete" rel="nofollow">
                                {{ __('interface.destroy') }}
                            </a>
                            <a href="{{ route('labels.edit', $label) }}">
                                {{ __('interface.edit') }}
                            </a>
                        </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
