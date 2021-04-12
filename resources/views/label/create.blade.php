@extends('layouts.app')

@section('content')
    <h1 class="mb-5">
        {{ __('interface.labels.create') }}
    </h1>
    {{ Form::model($label, [
        'url' => route('labels.store'),
        'class' => 'w-50'])
    }}
        @include('label.form')
        {{ Form::submit(__('interface.create'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection