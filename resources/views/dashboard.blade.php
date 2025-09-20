{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')
@section('title', 'Dashboard - ' . config('app.name'))
@section('page-title', 'Dashboard')

@section('content')
<!-- Page Header -->
<div class="mb-4">
    <h1 class="page-title">Dashboard</h1>
    <p class="page-subtitle">Welcome back! Here's what's happening with your application today.</p>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
   
</div>

<!-- Quick Actions -->
<div class="row mb-4">
    
</div>


@endsection

@push('styles')
<style>
    .list-group-item {
        border: none !important;
    }
</style>
@endpush

@push('scripts')
<script>
    
</script>
@endpush