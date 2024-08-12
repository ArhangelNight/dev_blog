@extends('layouts.main')

@section('content')
<main class="blog">
    <div class="container">
        <h1 class="edica-page-title" data-aos="fade-up">Categories</h1>
        <section class="featured-posts-section">
            <ul>
                @foreach($categories as $category)
                    <li><a href="{{route('category.post.index', $category->id)}}">{{$category->title}}</a></li>
                    <div class="blog-post-thumbnail-wrapper">
                        <img src="{{'storage/' . $category->image}}" alt="blog category">
                    </div>
                @endforeach
            </ul>

        </section>

    </div>

</main>

@endsection

