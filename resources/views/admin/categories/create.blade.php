@extends('layouts.admin')

@section('title', 'Nouvelle catégorie')
@section('page-title', 'Nouvelle catégorie')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <a href="{{ route('admin.categories.index') }}" class="hover:text-indigo-600 transition-colors">Catégories</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <span class="text-gray-600">Nouvelle</span>
@endsection

@section('content')
    <div class="max-w-lg">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            @include('admin.categories.form')
        </form>
    </div>
@endsection
