<!DOCTYPE html>
<html lang="en">
<head>
    <title>Email Verification Mail</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('backend/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" id="bootstrap-css">
    <script src="{{ asset('backend/bootstrap/js/bootstrap.min.js')}}"></script>

    <style>
        .invoice-title h2, .invoice-title h3 {
            display: inline-block;
        }


    </style>

</head>
<body onload="window.print()">

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <h3 class="pull-right"><img src="{{asset($company->logo?$company->logo:'frontend/logo_final.png')}}" width="150px"></h3>
                <hr>
                <h2>Email Verification </h2>
                @if(!Auth::guard('customer')->check())
                <p>Click Here : <a href="{{route('email-verification')}}">Email Verify</a></p>
                @endif
                <p>Verification Code : <strong>{{$customer->email_code}}</strong></p>

            </div>
            <br>
            <br>


        </div>
    </div>
    <?php
    $company = \App\CompanyProfile::find(1);

    ?>


    <br>
    <hr style="border-top: 2px double #bbb5b5">
    <div class="row mt-4">

        <p class="mt-2 col-6 offset-3" style="text-align: center;font-weight: bold"><strong>{{$company->name}} : </strong><i class="glyphicon glyphicon-earphone"></i> {{$company->email}} |  <i class="ion-ios-telephone"></i> {{$company->mobile}} </p>
    </div>
</div>


</body>
</html>
