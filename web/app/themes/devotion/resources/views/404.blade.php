@extends('layouts.app')

@section('content')
    @if (!have_posts())
        @include('partials.blocks.init')
    @endif
@endsection
