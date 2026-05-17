<form action="{{ $post->id ? route('blog.update', $post) : route('blog.store') }}" method="POST"
    class="vstaack gap-2 card" enctype="multipart/form-data">
    @csrf

    @if ($post->id)
        @method('PATCH')
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-group card-body">
        <label for="image">Image:</label>
        <input class="form-control" type="file" name="image">
    </div>
    <div class="form-group card-body">
        <label for="title">Titre:</label>
        <input class="form-control" type="text" name="title" value="{{ old('title', $post->title ?? '') }}">
    </div>


    {{-- CEUX-CI EST UN SLOG QUI SE REMPLIR AUTOMATIQUEMENT LORSQUE ON MET LE TITRE --}}
    {{-- <div class="form-group">
        <label for="slug">Slug:</label>
        <input class="form-control" type="text" name="slug" value="{{ old('slug', $post->slug ?? '') }}">
    </div> --}}

    <div class="form-group card-body">
        <label for="content">Contenu:</label>
        <textarea class="form-control" name="content">{{ old('content', $post->content ?? '') }}</textarea>
    </div>
    <div class="form-group card-body">
        <label for="category">Categorie:</label>
        <select class="form-control" name="category_id">
            <option value="">---Selectionner un categorie---</option>
            @foreach ($categories as $category)
                <option @selected(old('category_id', $post->category_id) == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    @php
        $tagsIds = $post->tags()->pluck('id');

    @endphp

    <div class="form-group card-body">
        <label for="tag">Tag:</label>
        <select class="form-control" name="tags[]" multiple>
            @foreach ($tags as $tag)
                <option @selected($tagsIds->contains($tag->id)) value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-primary form-control">
        {{ $post->id ? 'Modifier' : 'Créer' }}
    </button>
</form>
