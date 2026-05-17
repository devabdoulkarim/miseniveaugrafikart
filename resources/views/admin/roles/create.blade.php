@extends('layouts.admin')

@section('title', 'Nouveau rôle')
@section('page-title', 'Nouveau rôle')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <a href="{{ route('admin.roles.index') }}" class="hover:text-indigo-600 transition-colors">Rôles</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <span class="text-gray-600">Nouveau</span>
@endsection

@section('content')
    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf
        @include('admin.roles.form')
    </form>
@endsection
