@extends('base')

@section('title', 'Accueil du blog')



@section('content')

    <h1 class="h1">Mon blog</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">TITRE DU CONTENU</th>
                <th scope="col">CONTENUS</th>
                <th scope="col">CATEGORIES</th>
                <th scope="col">TAGS</th>
                <th scope="col">IMAGE:</th>
                <th scope="col">ACTIONS</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->content }}</td>
                    <td class="text-uppercase">
                        @if ($post->category)
                            <h2 class="badge text-bg-warning">{{ $post->category?->name }}</h2>
                        @else
                            <p class="badge text-bg-danger">Aucun</p>
                        @endif
                    </td>
                    <td class="">
                        @if (!$post->tags->isEmpty())
                            @foreach ($post->tags as $tag)
                                <span class="badge bg-secondary">{{ $tag->name }}</span>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @if ($post->image)
                            {{-- ImageUrl() ce trouve dans le model Post --}}
                            <img class="img-thumbnail" style="width: 70%; height:50px; object-fit: cover"
                                src="{{ $post->imageUrl() }}" alt="image">
                        @endif
                    </td>
                    <td><a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary">Lire</a></td>
                    <td><a href="{{ route('blog.edit', $post->id) }}"><i data-fa-symbol="edit"
                                class="fa-solid fa-pencil fa-fw fa-2x" title="Editer"></i></i></a></td>
                    <td><a href="{{ route('blog.delete', $post->id) }}" class="btn btn-danger"><i data-fa-symbol="delete"
                                class="fa-solid fa-trash fa-fw fa-2x" title="Supprimer"></i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $posts->links() }}

@endsection
