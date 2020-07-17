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
                            <li> Blog Details</li>
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
                <div class="col-lg-9 col-md-12">
                    <!--blog grid area start-->
                    <div class="blog_wrapper blog_wrapper_details">
                        <article class="single_blog">
                            <figure>
                                <div class="post_header">
                                    <h3 class="post_title">{{$blog->title}}</h3>
                                    <div class="blog_meta">
                                        <p><i class="ion-android-calendar" style="color: #3fb144"></i> <span style="color:#808480">{{date('d M,Y',strtotime($blog->publish_date))}}</span> | <a href="{{route('blog-cagetory-view',['slug'=>$blog_cagetory->slug])}}" style="color: #3fb144">{{$blog->blog_category->name}}</a> </p>
                                    </div>
                                </div>
                                <div class="blog_thumb">
                                    <a href="#"><img src="{{asset($blog->photo)}}" alt=""></a>
                                </div>
                                <figcaption class="blog_content">
                                    <div class="post_content">
                                        {!! $blog->details  !!}
                                      </div>


                                </figcaption>
                            </figure>
                        </article>

                        <div class="comments_box">
                            <h3><i class="ion-android-chat"></i> {{$blog->comments->count()}} Comments	</h3>

                            @foreach($blog->comments as $comment)
                            <div class="comment_list">
                                <div class="comment_thumb">
                                    <img src="{{asset('frontend/assets/img/blog/comment3.png.jpg')}}" alt="">
                                </div>
                                <div class="comment_content">
                                    <div class="comment_meta">
                                        <h5><a href="#">{{$comment->customer->name}}</a></h5>
                                        <span>{{date('d M,Y',strtotime($comment->created_at))}}  {{$comment->created_at->diffForHumans()}}</span>
                                    </div>
                                    <p>{{$comment->details}}</p>

                                </div>

                            </div>
                                @endforeach


                        </div>
                        <div class="comments_form">
                            <h3><i class="ion-edit"></i> Post Your Comments</h3>
                            <form  action="{{route('comment-save')}}" method="post" onsubmit="return validate_form()">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <label for="review_comment">Comment <span>*</span> </label>
                                        <textarea required name="details" id="review_comment" style="border: 1px solid #b8e6b9"></textarea>
                                        <input type="hidden" name="blog_id" value="{{$blog->id}}">
                                        @error('details')
                                        <label for="review_comment"><span style="color:red">{{$message}}</span> </label>
                                        @enderror

                                    </div>

                                </div>
                                <button class="button" type="submit">Post Comment</button>
                            </form>
                        </div>
                    </div>
                    <!--blog grid area start-->
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="blog_sidebar_widget">

                        <div class="widget_list comments">
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action active disabled">
                                    <i class="fa fa-book"></i> CATEGORIES
                                </a>
                                @foreach($cagetory as $single_category)
                                    <a href="{{route('blog-cagetory-view',['slug'=>$single_category->slug])}}" class="list-group-item list-group-item-action" style="font-weight: bold"><i class="ion-arrow-right-b"></i> {{$single_category->name}}
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

        /*.page-item.active .page-link {*/
        /*z-index: 1;*/
        /*color: #fff;*/
        /*background-color: #40a944;*/
        /*border-color: #40a944;*/
        /*}*/

    </style>

@endsection

@section('script')


@endsection