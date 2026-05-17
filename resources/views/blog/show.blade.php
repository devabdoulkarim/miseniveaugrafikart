@extends('base')

@section('title', $post->title)



@section('content')

    <article>

        <h1>{{ $post->title }}</h1>
        <p>{{ $post->content }}</p>
        <h2>Image
            <p>
                @if ($post->image)
                    {{-- ImageUrl() ce trouve dans le model Post --}}
                    <img class="img-thumbnail" style="width: 100%; height:250px; object-fit: cover"
                        src="{{ $post->imageUrl() }}" alt="image">
                @endif
            </p>
        </h2>

    </article>

@endsection
