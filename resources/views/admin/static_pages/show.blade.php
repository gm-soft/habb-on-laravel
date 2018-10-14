
@extends('layouts.admin-layout')
@section('title', 'HABB | Статическая страница')

@section('content')
    <div class="container mt-3">

        <div class="">
            <h1 class="display-4">{{ $static_page->title }}</h1>

            <div>{{ $static_page->unique_name }}</div>

        </div>

        <div class="mt-3 row">

            <div class="col-md-8">
                <div class="">
                    {!! $static_page->content !!}
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">

                        <div class="mt-1">
                            {{ link_to_action('StaticPageController@edit', 'Редактировать', ['id' => $static_page->id], ['class' => 'btn btn-primary btn-block mb-1']) }}

                            {{ link_to_action('StaticPageController@index', 'В список', null, ['class' => 'btn btn-light btn-block mb-3']) }}
                        </div>

                        <div class="mt-1">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection