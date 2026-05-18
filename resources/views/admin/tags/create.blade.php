@extends('layouts.admin')

@section('title', 'Nouveau tag')
@section('page-title', 'Nouveau tag')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <a href="{{ route('admin.tags.index') }}" class="hover:text-indigo-600 transition-colors">Tags</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <span class="text-gray-600">Nouveau</span>
@endsection

@section('content')
    <div class="max-w-lg">
        <form action="{{ route('admin.tags.store') }}" method="POST">
            @csrf
            @include('admin.tags.form')
        </form>
    </div>
@endsection
