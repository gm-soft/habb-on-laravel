
@extends('layouts.admin-layout')
@section('title', 'Создание пары ключ-значение')

@section('content')
    <div class="container">
        <h1 class="mt-1">Новая пара ключ-значение</h1>
        {!! Form::open(array('action' => array('KeyValueController@store'))) !!}
            @include('admin.keyValues.form')
        {!! Form::close() !!}
    </div>


@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script>
        ckEditorHelpers.replace('value');
    </script>
@endsection