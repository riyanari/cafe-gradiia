@extends('Admin.Layouts.main')

@section('content')

    <!-- Hero Section -->
    @include('User.Pages.Home.hero')

    <!-- Features Section -->
    @include('User.Pages.Home.allCafes')

    <!-- Portfolio Section -->
    @include('User.Pages.Home.price')

@endsection
