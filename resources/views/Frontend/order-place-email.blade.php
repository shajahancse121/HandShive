<!DOCTYPE html>
<html lang="en">
<head>
    <title>BS{{$order->invoice_no}}-order placed </title>
    <meta charset="utf-8">

    <style>

    </style>

</head>
<body>
<?php
$company = \App\CompanyProfile::find(1);

?>
<p>Hello {!!isset($order->other_shipping->name)?$order->other_shipping->name:$order->blling->name !!},Your Order- BS{{$order->invoice_no}} is placed</p>
<p>Total bill is {{number_format($order->total_amount-$order->cupon_amount+$order->shipping_amount)}} TK. Thank you stay with Bonaji Shop.</p>

</body>
</html>
