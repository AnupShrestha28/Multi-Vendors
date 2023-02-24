@extends('frontend.master_dashboard')
@section('main')


@section('title')
    Blog Page
@endsection

<div class="page-header mt-30 mb-75">
    <div class="container">
        <div class="archive-header">
            <div class="row align-items-center">
                <div class="col-xl-3">
                    <h1 class="mb-15">Blog & News</h1>
                    <div class="breadcrumb">
                        <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                        <span></span> Blog & News
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<div class="page-content mb-50">


    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="shop-product-fillter mb-50 pr-30">
                    <div class="totall-product">
                       
                    </div>
                    <div class="sort-by-product-area">
                        
                        <div class="sort-by-cover">
                            <div class="sort-by-product-wrap">
                               
                               
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="loop-grid loop-list pr-30 mb-50">

                    @foreach($blogpost as $post)
                    <article class="wow fadeIn animated hover-up mb-30 animated">
                        <div class="post-thumb" style="background-image: url({{asset($post->post_image) }})">
                            <div class="entry-meta">
                                <a class="entry-meta meta-2" href="blog-category-grid.html"><i class="fi-rs-play-alt"></i></a>
                            </div>
                        </div>
                        <div class="entry-content-2 pl-50">
                            <h3 class="post-title mb-20">
                                <a href="{{ url('post/details/'.$post->id.'/'.$post->post_slug) }}">{{$post->post_title}}</a>
                            </h3>
                            <p class="post-exerpt mb-40">{{$post->post_short_description}}</p>
                            <div class="entry-meta meta-1 font-xs color-grey mt-10 pb-10">
                                <div>
                                    <span class="post-on">{{$post->created_at->format('M d Y')}}</span>
                                </div>
                                <a href="{{ url('post/details/'.$post->id.'/'.$post->post_slug) }}" class="text-brand font-heading font-weight-bold">Read more <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </article>
                    @endforeach

                </div>
               
            </div>
            <div class="col-lg-3 primary-sidebar sticky-sidebar">
                <div class="widget-area">
                   
                    <div class="sidebar-widget widget-category-2 mb-50">
                        <h5 class="section-title style-1 mb-30">Category</h5>
                        <ul>
                            @foreach($blogcategories as $category)

                            @php

                            $posts = App\Models\BlogPost::where('category_id',$category->id)->get();

                            @endphp
                            <li>
                                <a href="{{ url('post/category/'.$category->id.'/'.$category->blog_category_slug )}}"> <img src="{{asset('frontend/assets/imgs/theme/icons/category-1.svg')}}" alt="" />{{ $category->blog_category_name }}</a><span class="count">{{ count($posts) }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    
                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection