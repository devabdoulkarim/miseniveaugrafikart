@extends('layouts.admin')

@section('title', 'Modifier — ' . $post->title)
@section('page-title', 'Modifier l\'article')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <a href="{{ route('admin.posts.index') }}" class="hover:text-indigo-600 transition-colors">Articles</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <span class="text-gray-600 truncate">{{ Str::limit($post->title, 30) }}</span>
@endsection

@section('actions')
    <a href="{{ route('blog.show', $post->slug) }}" target="_blank"
        class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 hover:border-indigo-400 text-gray-600 hover:text-indigo-600 rounded-xl text-sm font-medium transition-colors">
        <i class="fa-solid fa-eye text-xs"></i> Voir l'article
    </a>
@endsection

@section('content')
    @include('admin.posts.form')
@endsection
