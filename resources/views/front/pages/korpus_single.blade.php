@extends('front.layouts.master2')

@section('title')
    {{ $korpus->name }}
@endsection

@section('content')
    <!-- Detail Start -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-column text-left mb-4">
                    <h5 class="text-primary mb-3">{{ $korpus->name }}</h5>
                    <h1 class="mb-3">{{ $korpus->title }}</h1>
                </div>

                <div class="mb-5">
                    <img style="max-height: 800px;
                    height: 800px;
                    object-fit: cover;
                    width: 1200px;" class="img-thumbnail mb-4 p-3" src="{{ asset($korpus->img) }}" alt="Image">
                    <p>{{ $korpus->desc }}</p>
                    
                </div>
        
            </div>

        </div>
    </div>
    <!-- Detail End -->
@endsection