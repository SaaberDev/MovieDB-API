@extends('layouts.app')
@section('title', 'Movies')
@push('styles')
    <style>
        .search {
            display: inline-flex;
            float: right;
        }
        .pagination .page-number.current, .pagination .page-number:hover {
            background: #ffaa3c;
            color: white;
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
    @livewire('movies-component')
@endsection

@push('scripts')
@endpush
