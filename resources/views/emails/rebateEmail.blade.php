<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Siproced</title>
</head>
<body>


    <h3>{{$emailData['title']}}</h3>

    <h3>{{'Date: ' . $emailData['dateOrder']}}</h3>

    <h3>{{'Rebate: ' . $emailData['rebate']}}</h3>

    <h3>{{'Customer: ' . $emailData['customer']}}</h3>

    <h3>{{'Vendor: ' . $emailData['vendor']}}</h3>


    <p>We have received your order and it will be processed very soon.</p>

    <p>Thank you</p>
    
</body>
</html>

