@extends('layouts.admin_layout')
@section('title','Nowy post')

@section('content')
<div class="mx-5">
    <div id="img-load-id" class="img-load d-none">
        <img class="img-load" src="{{ asset('img/icon/Spinner.svg') }}" alt="" />
    </div>
    <h2>Nowy post</h2>

    <form action="{{ route('createPostsAdmin') }}" enctype="multipart/form-data" method="POST" role="form">

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            @foreach ($errors->all() as $error)
            {{ $error }}<br />
            @endforeach

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <!-- ^akcja ktora obsluguje formulaz -->
        <input type="hidden" name="_token" value="{{ csrf_token()}}" />
        <input type="hidden" name="id" />
        <!-- ^zeby nie mozna bylo wysylac bez formulaza -->
        <div class="form-group">
            <label for="status">Status publikacji</label> <br>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary">
                    <input type="radio" name="status" id="option1" autocomplete="off" value=1> Opublikowana
                </label>
                <label class="btn btn-secondary active">
                    <input type="radio" name="status" id="option2" autocomplete="off" checked value=0> Niepublikowana
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="title">Nagłówek</label>
            <input type="text" class="form-control" placeholder="Nagłówek" name="title" required />
        </div>
        <div class="form-group">
            <label for="content">Tekst</label>
            <textarea type="text" class="ckeditor form-control" name="content" placeholder="Tekst" required></textarea>
        </div>
        <div class="form-group">
            <img id="imgInpShowBig" alt="" class="mx-auto d-block" style="max-width: 50%" />
            <label for="img">Duży obrazek</label>
            <input id="imgInpB" type="file" class="form-control" name="img" />
        </div>
        <div class="form-group">
            <img id="imgInpShowSmall" alt="" class="mx-auto d-block" style="max-width: 20%" />
            <label for="img_thumb">Mały obrazek</label>
            <input id="imgInpS" type="file" class="form-control" name="img_thumb" />
        </div>
        <div class="form-group">
            <label for="excerpt">Krótki opis</label>
            <input type="text" class="form-control" name="excerpt" placeholder="Krótki opis" required />
        </div>

        <div class="form-group">
            <label for="type">Temat</label>
            <input id="topic" type="text" class="form-control" name="type" placeholder="Temat" />
        </div>
        <input type="submit" value="Ok" class="btn btn-dark px-5">    

    </form>

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('tensor/tf.min.js') }}"></script>
        <script src="{{ asset('tensor/teachablemachine-image.min.js') }}"></script>
        <script src="{{ asset('tensor/jquery-3.5.0.js') }}"></script>
        <script src="{{ asset('tensor/img-man.js') }}"></script>

        <script>
            imgInpB.onchange = evt => {
                const [file] = imgInpB.files
                if (file) {
                    imgInpShowBig.src = URL.createObjectURL(file)
                }
            }

            imgInpS.onchange = evt => {
                const [file] = imgInpS.files
                if (file) {
                    imgInpShowSmall.src = URL.createObjectURL(file)
                }
            }
        </script>
        <style>
            .img-load {
                width: 100vw;
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                z-index: 999;
                height: 100%;
                overflow-y: auto;
            }

            .img-load svg {
                animation: 2s linear infinite svg-animation;
                max-width: 100px;
            }

            @keyframes svg-animation {
                0% {
                    transform: rotateZ(0deg);
                }

                100% {
                    transform: rotateZ(360deg);
                }
            }

            .img-load>circle {
                animation: 1.4s ease-in-out infinite both circle-animation;
                display: block;
                fill: transparent;
                stroke: #2f3d4c;
                stroke-linecap: round;
                stroke-dasharray: 283;
                stroke-dashoffset: 280;
                stroke-width: 10px;
                transform-origin: 50% 50%;
            }

            @keyframes circle-animation {

                0%,
                25% {
                    stroke-dashoffset: 280;
                    transform: rotate(0);
                }

                50%,
                75% {
                    stroke-dashoffset: 75;
                    transform: rotate(45deg);
                }

                100% {
                    stroke-dashoffset: 280;
                    transform: rotate(360deg);
                }
            }
        </style>
</div>
@endsection('content')