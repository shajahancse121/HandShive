@extends('Frontend.layout')

@section('content')
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <h3>Blog</h3>
                        <ul>
                            <li><a href="{{route('home')}}">home</a></li>
                            <li>blog</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!--blog area start-->
    <div class="blog_page_section mt-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="blog_sidebar_widget">

                        <div class="widget_list comments">
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action active disabled">
                                    <i class="fa fa-book"></i> CATEGORIES
                                </a>
                                @foreach($cagetory as $single_category)
                                    <a href="{{route('blog-cagetory-view',['slug'=>$single_category->slug])}}" class="list-group-item list-group-item-action" style="font-weight: bold;color:{{$category_id==$single_category->id?'green':'black'}}"><i class="ion-arrow-right-b"></i> {{$single_category->name}}
                                        @if($single_category->blogs->count())
                                            <span class="badge badge-success">{{$single_category->blogs->count()}}</span></a>
                                    @endif
                                @endforeach
                            </div>
                        </div>


                        <div class="widget_list widget_tag">
                            <div class="widget_title">
                                <h3><i class="fa fa-check-square" style="font-size: 17px;color: #3da741"></i> Popular Blog</h3>
                            </div>
                            <div class="tag_widget">
                                <ul>
                                    @foreach($blogs as $blog)
                                        @if(isset($blog->tag))
                                        <li><a href="{{route('blog-tag-view',['tag'=>str_replace(" ","-",$blog->tag)])}}">{{$blog->tag}}</a></li>
                                        @endif
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">
                    <div class="blog_wrapper">
                        <div class="row">
                            @foreach($cagetory_blog as $blog)

                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <article class="single_blog" style="border: 0px solid #e3e8e3;padding: 10px;box-shadow: 0 5px 12px rgba(126,142,177,.2)">
                                        <figure>
                                            <div class="blog_thumb text-center">
                                                <a href="{{route('blog-details',['slug'=>$blog->slug])}}" class="text-center"><img src="{{asset($blog->photo?$blog->photo:'upload/category/no-image.png')}}" alt=""></a>
                                            </div>
                                            <figcaption class="blog_content">
                                                <h4 class="post_title" style="height: 40px"><a href="{{route('blog-details',['slug'=>$blog->slug])}}">{{$blog->title}}</a></h4>
                                                <div class="articles_date">
                                                    <p><i class="ion-android-calendar" style="color: #3fb144"></i> <span style="color:#808480">{{date('d M,Y',strtotime($blog->publish_date))}}</span> | <a href="{{route('blog-cagetory-view',['slug'=>$blog->blog_category->slug])}}" style="color: #3fb144">{{$blog->blog_category->name}}</a> </p>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </article>
                                </div>

                            @endforeach

                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="row" style="height: 150px"></div>
    </div>
    <!--blog area end-->


@endsection
@section('style')


    <style>
        .list-group-item.active {
            z-index: 2;
            color: #fff;
            background-color: #40a944;
            border-color: #40a944;
            font-weight: bold;
            font-size: 19px;
        }

        .page-item.active .page-link {
            z-index: 1;
            color: #fff;
            background-color: #40a944;
            border-color: #40a944;
        }

    </style>

@endsection

@section('script')


@endsection