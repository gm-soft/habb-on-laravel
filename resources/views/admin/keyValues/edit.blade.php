
@extends('layouts.admin-layout')
@section('title', 'Редактирование пары ключ-знчение')

@section('content')
    <div class="container">
        <h1 class="mt-1">Редактирование пары ключ-знчение [{{ $instance->id }}]</h1>
        {!! Form::model($instance, ['method' => 'PATCH', 'action' => ['KeyValueController@update', $instance->id]]) !!}
        @include('admin.keyValues.form')
        {!! Form::close() !!}
    </div>


@endsection

@section('styles')
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script>
        ckEditorHelpers.replace('value');
    </script>
@endsection