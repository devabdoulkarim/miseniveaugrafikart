@extends('layouts.admin')

@section('title', 'Créer un article')
@section('page-title', 'Créer un article')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <a href="{{ route('admin.posts.index') }}" class="hover:text-indigo-600 transition-colors">Articles</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <span class="text-gray-600">Créer</span>
@endsection

@section('content')
    @include('admin.posts.form')
@endsection
