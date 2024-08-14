@extends('layouts.main')

@section('content')
<main class="blog">
    <div class="container">
        <h1 class="edica-page-title" data-aos="fade-up">Blog</h1>

        <div class="row">
            <div class="col-md-8">
                <section>
                    <div class="row blog-post-row">
                        @foreach($posts as $post)
                        <div class="col-md-6 blog-post" data-aos="fade-up">
                            <div class="blog-post-thumbnail-wrapper">
                                <img src="{{'storage/' . $post->preview_image}}" alt="blog post">
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="blog-post-category">{{$post->category->title}}</p>
                                @auth()
                                    <form action="{{route('post.like.store', $post->id)}}" method="post">
                                        @csrf
                                        <span>{{$post->liked_users_count}}</span>
                                        <button type="submit" class="border-0 bg-transparent">

                                            {{--    <i class="fa{{auth()->user()->likedPosts->contains($post->id) ? 's' : 'r'}} fa-heart"></i>  - тоже самое что ниже через if --}}
                                            @if(auth()->user()->likedPosts->contains($post->id))
                                                <i class="fas fa-heart"></i>
                                            @else
                                                <i class="far fa-heart"></i>
                                            @endif
                                        </button>
                                    </form>
                                @endauth
                                @guest()
                                    <div>
                                        <span>{{$post->liked_users_count}}</span>
                                        <i class="far fa-heart"></i>
                                    </div>
                                @endguest
                            </div>
                            <a href="{{route('post.show', $post->id)}}" class="blog-post-permalink">
                                <h6 class="blog-post-title">{{$post->title}}</h6>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="mx-auto" style="margin-top: -100px">
                            {{$posts->links()}}
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-4 sidebar" data-aos="fade-left">
                <div class="widget widget-post-list">
                    <h5 class="widget-title">Categories</h5>
                    <ul class="post-list">
                        @foreach($categories as $category)
                        <li class="post">
                            <a href="{{route('post.show', $category->id)}}" class="post-permalink media">
                                <img src="{{'storage/' . $category->image}}" alt="blog post" class="round" width="80" height="60">
                                <div class="media-body">
                                    <h6 class="post-title">{{$category->title}}</h6>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="widget widget-post-list">
                    <h5 class="widget-title">Popular posts</h5>
                    <img src="{{asset('assets/images/blog_widget_categories.jpg')}}" alt="categories" class="w-100">
                    <ul class="post-list">
                        @foreach($likedPosts as $post)
                            <li class="post">
                                <a href="{{route('post.show', $post->id)}}" class="post-permalink media">
                                    <img src="{{'storage/' . $post->preview_image}}" alt="blog post" class="round" width="80" height="70">
                                    <div class="media-body">
                                        <h6 class="post-title">{{$post->title}}</h6>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

</main>

@endsection

