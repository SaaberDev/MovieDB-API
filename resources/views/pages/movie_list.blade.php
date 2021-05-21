@extends('layouts.app')
@section('title', 'Movies')
@push('styles')
    <style>
        .search {
            display: inline-flex;
            float: right;
        }
    </style>
@endpush

@section('content')
    @livewire('movies-component')
@endsection

@push('scripts')
@endpush
