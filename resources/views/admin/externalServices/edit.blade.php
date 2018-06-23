@extends('layouts.admin-layout')
@section('title', 'Редактирование записи о внешнем сервисе')

@php
    /** @var \App\Models\ExternalService $model */
@endphp

@section('content')
    <div class="container">
        <h1 class="mt-1">Редактирование записи "{{ $model->title }} [ID:{{ $model->id }}]"</h1>
        <div class="">

            {!! Form::model($model, ['method' => 'put', 'action' => ['ExternalServicesController@update', $model->id]]) !!}
                @include('admin/externalServices/form')
            {!! Form::close() !!}
        </div>
    </div>

@endsection