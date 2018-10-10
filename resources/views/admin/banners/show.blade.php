
@extends('layouts.admin-layout')
@section('title', 'HABB | Информация о баннере')

@section('content')
    <div class="container mt-3">
        <div class="mt-1">
            <h1 class="mt-1">Баннер #{{ $banner->id }}</h1>
            <p class="text-muted">Создан: {{ $banner->created_at }}. Обновлен: {{ $banner->updated_at }}</p>
        </div>

        <div class="row mt-3">
            <div class="col-sm-8">
                <dl>
                    <dt>Подзаголовок</dt>
                    <dd>{{ $banner->started_at }}</dd>

                    <dt>Присутствует на главной</dt>
                    <dd>{{ $banner->attached_to_main_page ? "Да" : "Нет" }}</dd>

                    <dt>Картинка</dt>
                    <dd>{{ $banner->image_path }}</dd>
                </dl>


                <div class="mt-2">
                    <img src="{{ url($banner->image_path) }}" class="w-100" />
                </div>

            </div>


            <div class="col-sm-4">
                {{ link_to_action('BannerController@index', 'В список', [], ['class' => 'btn btn-light']) }}
                <div class="float-sm-right">

                    {{ link_to_action('BannerController@edit', 'Редактировать', ['id' => $banner->id], ['class' => 'btn btn-primary']) }}
                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteDialog">Удалить</button>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="deleteDialog" tabindex="-1" role="dialog" aria-labelledby="deleteDialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Удаление объекта</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['method' =>'delete', 'action' => ['BannerController@destroy', $banner->id]]) !!}
                <div class="modal-body">
                    Вы уверены, что хотите удалить запись о турнире #{{ $banner->id }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-outline-danger">Удалить</button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection