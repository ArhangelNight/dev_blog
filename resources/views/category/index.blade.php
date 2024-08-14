@extends('layouts.main')

@section('content')
    <main class="blog">
        <div class="container">
            <section class="featured-posts-section">
                <h1 class="edica-page-title" data-aos="fade-up">Categories</h1>
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-md-4 fetured-post blog-post" data-aos="fade-up">
                            <a href="{{route('category.post.index', $category->id)}}">
                                <div class="blog-post-thumbnail-wrapper">
                                    <img src="{{'storage/' . $category->image}}" alt="blog post">
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="blog-post-category">{{$category->title}}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </main>

@endsection

