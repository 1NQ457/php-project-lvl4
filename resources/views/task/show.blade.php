@extends('layouts.app')

@section('content')
    <h1 class="mb-5">
        {{ __('interface.tasks.show') }}{{ $task->name}}
        <a href="{{ route('tasks.edit', $task) }}">⚙</a>
    </h1>
    <p>{{ __('interface.name') }}: {{ $task->name }}</p>
    <p>{{ __('interface.status') }}: {{ $statusName }}</p>
    <p>{{ __('interface.description') }}: {{ $task->description }}</p>
    <p>{{__('interface.labels.name')}}: </p>
    @if ($labels)    
        <ul>
            @foreach ($labels as $label)
            <li>{{$label->name}}</li>
            @endforeach
        </ul>
    @endif
@endsection