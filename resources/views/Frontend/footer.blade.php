<footer class="footer_widgets d-none d-md-block">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-7">
                    <div class="widgets_container contact_us">
                        <div class="footer_logo">
                            <a href="{{route('home')}}"><img width="160px" src="{{asset($company->logo?$company->logo:'frontend/logo_final.png')}}" alt=""></a>
                        </div><br>

                        <p><span>Address:</span> {{$company->address}}</p>
                        <p><span>Email:</span> <a href="#">{{$company->email}}</a></p>
                        <p><span>Call us:</span> <a href="tel:(08)23456789">{{$company->mobile}}</a> </p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-5">
                    <div class="widgets_container widget_menu">
                        <h3>Information</h3>
                        <div class="footer_menu">
                            <ul>
                                <li><a href="{{route('about-us')}}">About Us</a></li>
                                <li><a href="{{route('shop')}}"> Products</a></li>
                                <li><a href="{{route('return-policy')}}">Return Policy</a></li>
                                <li><a href="{{route('privacy-policy')}}"> Privacy Policy</a></li>
                                <li><a href="{{route('term-conditions')}}"> Terms & Conditions</a></li>


                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-4">
                    <div class="widgets_container widget_menu">
                        <h3 class="text-center">Follow Us</h3>
                        <div class="footer_menu social_icon">
                            <ul>
                                <li><a href=" {{$company->facebook}}" target="_blank"><i class="ion-social-facebook"></i></a></li>
                                <li><a href=" {{$company->youtube}}" target="_blank"><i class="ion-social-youtube-outline"></i></a></li>
                                <li><a href=" {{$company->twitter}}" target="_blank"><i class="ion-social-twitter"></i></a></li>
                                <li><a href=" {{$company->instragram}}" target="_blank"><i class="ion-social-instagram-outline"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="widgets_container widget_newsletter">
                        <h3>Payment Method</h3>
                        <img src="{{asset('frontend/assets/img/icon/payment-method.png')}}">
                    </div>
                    <div class="widgets_container widget_newsletter mt-5">
                        <h3>Sign Up Newsletter</h3>
                        <div class="subscribe_form">
                            <form id="mc-form" class="mc-form footer-newsletter" novalidate="true">
                                <input id="mc-email" type="email" autocomplete="off" placeholder="Enter you email" name="EMAIL">
                                <button id="mc-submit">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="copyright_area text-center">
                        <p>Copyright © 2020 <a href="#">{{$company->name}}</a> . All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

