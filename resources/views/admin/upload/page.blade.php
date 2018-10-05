@extends('layouts.admin-layout')

@section('title', 'Загрузите файл на сервер')

@section('content')

    <div class="container mt-3">

        <h1>Загрузите файл на сервер</h1>

        <div class="my-2">
            <a href="{{ action('UploadController@index') }}" class="btn btn-secondary">В список</a>
        </div>

        <div class="mt-2">

            <div class="card">
                <div class="card-body">
                    {!! Form::open(['action' => ['UploadController@store'], 'files' => true, 'enctype' => 'multipart/form-data', 'class' => 'form__tag']) !!}


                    <div class="form-group row">
                        <label for="file-control" class="col-2">Прикрепите файл</label>

                        <div class="col">
                            <input type="file" name="file" id="file-control" class="form-control-file" />
                        </div>


                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary submit-btn__tag">Загрузить</button>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>

        </div>


    </div>

@endsection