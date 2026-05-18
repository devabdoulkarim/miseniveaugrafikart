@extends('layouts.admin')

@section('title', 'Modifier — ' . $category->name)
@section('page-title', 'Modifier la catégorie')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <a href="{{ route('admin.categories.index') }}" class="hover:text-indigo-600 transition-colors">Catégories</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <span class="text-gray-600">{{ $category->name }}</span>
@endsection

@section('content')
    <div class="max-w-lg">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.categories.form')
        </form>
    </div>
@endsection
