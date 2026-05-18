@extends('layouts.admin')

@section('title', 'Modifier — ' . $tag->name)
@section('page-title', 'Modifier le tag')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <a href="{{ route('admin.tags.index') }}" class="hover:text-indigo-600 transition-colors">Tags</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <span class="text-gray-600">{{ $tag->name }}</span>
@endsection

@section('content')
    <div class="max-w-lg">
        <form action="{{ route('admin.tags.update', $tag) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.tags.form')
        </form>
    </div>
@endsection
