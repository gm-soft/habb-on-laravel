@extends('layouts.admin-layout')

@section('title', 'Файлы сервера')

@section('content')

    <div class="container mt-3">

        <h1>Список файлов на сервере</h1>

        <div class="mt-2">
            <a href="{{ action('UploadController@page') }}" class="btn btn-primary">Загрузить новую картинку</a>
        </div>

        <div class="mt-2">
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>Путь до файла</td>
                    <td>Ссылка для вставки</td>
                    <td>Размер</td>
                    <td>Изменен/создан</td>
                </tr>
                </thead>
                <tbody>

                @foreach($files as $file)
                    <tr>
                        <td><a href="{{ asset($file->filepath) }}" title="Открыть в новой вкладке" target="_blank">{{$file->filepath}}</a></td>
                        <td>{{ asset($file->filepath) }}</td>
                        <td>{{ $file->size }}</td>
                        <td>{{ $file->lastModified }}</td>
                    </tr>


                @endforeach

                </tbody>
            </table>

        </div>


    </div>

@endsection