@extends('Frontend.layout')

@section('content')

    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <h3>Return Policy</h3>
                        <ul>
                            <li><a href="{{route('home')}}">home</a></li>
                            <li>Return policy</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="faq_content_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="faq_content_wrapper">
                        <h4 class="text-left">Return policy</h4>
                        <p><strong>A.1.</strong> We try to serve our customers the best way we can. However, some mistakes might happen in our packaging and delivering a product. You do not have to be worried because we care about our customers and provide aftersales services such as return and refund.</p>
                        <p>A purchaser may return any product within seven days of purchasing under these provisions:</p>
                        <ul style="padding-left:50px;list-style: inherit;">
                            <li>The product does match the description.</li>
                            <li>Receiving damaged product.</li>
                            <li>Receiving unusable product.</li>
                            <li>Any deviation in the quality, quantity or size of the product.</li>
                            <li>Product is incorrect or incomplete.</li>
                        </ul>
                         <br>
                        <h5 style="font-weight: bolder">P.S. Change of mind is not acceptable.</h5>
                        <p><strong>A.2.</strong> A customer may return an unopened and defective product within seven days after receiving the product unless:</p>
                        <ul style="padding-left:50px;list-style: inherit;">
                            <li>Damaged by misuse.</li>
                            <li>After using the consumable product.</li>
                            <li>Products with damaged or missing serial number/UPC or barcode on it.</li>
                            <li>Any damages that do not meet the manufacturer's provision.</li>
                        </ul>
                        <br>
                        <h5  style="font-weight: bolder">P.S. Bonaji Shop will not recognize any return claim after seven days has elapsed. </h5>
                    <br>
                        <p>After fulfilling all the conditions, a customer must return the product with original packaging, accessories, and all other items that were initially included in the packaging. Failing to return the product as per the provision will not bring any refund or another product.</p>
                    <br>
                        <h4>Refund policy</h4>
                        <p>Customer service is our priority. If we fail to serve you as to the expectation due to any unexpected situation, we will notify you of our confession through email or SMS within 24 hours. Bonaji Shop Ltd. will solve any refund issue under the provisions:</p>
                        <ol>
                            <li>Our failure to deliver the product.</li>
                            <li>Return of a product for which the customer has already paid.</li>
                            <li>Cancellation of an order before we start shipping it from our end.</li>
                        </ol>
                        <p>For the situations as mentioned earlier, the refund amount will be credited to customer's Bonaji Shop account, and the balance can be used for buying products from Bonaji Shop at any moment thereafter.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->
    <!--services img area-->
    <!--shipping area start-->




@endsection
@section('style')
    <style>


        @media (max-width: 700px) {



        }
        ul {

            margin: 0;

        }
    </style>


@endsection

@section('script')


@endsection