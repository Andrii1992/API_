@extends('layouts.admin_layout')
@section('title','Edycja')

@section('content')
<div class="mx-5">
    <div id="img-load-id" class="img-load d-none">
        <img class="img-load" src="{{ asset('img/icon/Spinner.svg') }}" alt="" />
    </div>
    <h2>Edycja</h2>

    <form action="{{ route('editStorePostsAdmin') }}" enctype="multipart/form-data" method="POST" role="form">
        <!-- ^akcja ktora obsluguje formulaz -->

        <input type="hidden" name="_token" value="{{ csrf_token()}}" />
        <input type="hidden" name="id" value="{{ $post->id }}" />
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            @foreach ($errors->all() as $error)
            <?= str_replace('content', '"Tekst"', $error) ?><br />
            @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="form-group">
            <label for="status">Status publikacji</label> <br>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                @if($post->status)
                <label class="btn btn-secondary ">
                    <input type="radio" name="status" id="option1" autocomplete="off" checked value=1> Opublikowana
                </label>
                <label class="btn btn-secondary active">
                    <input type="radio" name="status" id="option2" autocomplete="off" value=0> Niepublikowana
                </label>
                @else
                <label class="btn btn-secondary">
                    <input type="radio" name="status" id="option1" autocomplete="off" value=1> Opublikowana
                </label>
                <label class="btn btn-secondary active">
                    <input type="radio" name="status" id="option2" autocomplete="off" checked value=0> Niepublikowana
                </label>
                @endif
            </div>
        </div>

        <!-- ^zeby nie mozna bylo wysylac bez formulaza -->
        <div class="form-group">
            <label for="title">Nagłówek</label>
            <input type="text" class="form-control" name="title" placeholder="Nagłówek" value="{{$post->title}}" required />
        </div>
        <div class="form-group">
            <label for="content">Tekst</label>
            <textarea type="text" class="ckeditor form-control" name="content" placeholder="Tekst">{{$post->content}}</textarea>
        </div>
        <div class="form-group">
            <img id="imgInpShowBig" src="{{asset('img/gallery/' . $post->img)}}" alt="" class="mx-auto d-block" style="max-width: 50%;">
            <h5 class="text-center">Duży obrazek</h5>
            <input id="imgInpB" class="mx-auto d-block form-control" type="file" name="img" value="{{$post->img}}" />
        </div>
        <div class="form-group">
            <img id="imgInpShowSmall" src="{{asset('img/gallery/' . $post->img_thumb)}}" alt="" class="mx-auto d-block" style="max-width: 20%;">
            <h5 class="text-center">Mały obrazek</h5>
            <input id="imgInpS" class="mx-auto d-block form-control" type="file" name="img_thumb" value="{{$post->img_thumb}}" />
        </div>
        <div class="form-group">
            <label for="excerpt">Krótki opis</label>
            <input type="text" class="form-control" name="excerpt" placeholder="Krótki opis" value="{{$post->excerpt}}" required />
        </div>
        <div class="form-group">
            <label for="type">Temat</label>
            <input id="topic" type="text" class="form-control" name="type" placeholder="Temat" value="{{$post->type}}" />
        </div>
        <input type="submit" value="Zmien" class="btn btn-dark px-5">
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
    </form>
</div>
@endsection('content')