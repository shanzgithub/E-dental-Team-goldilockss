<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Dental</title>
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles can be added here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
        }
        .invoice-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 40px 60px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .invoice-header {
            border-bottom: 2px solid #ccc;
            padding-bottom: 20px;
            text-align: center;
        }
        .invoice-logo {
            max-width: 150px;
        }
        .invoice-title {
            font-size: 24px;
            margin-top: 20px;
            font-weight: bold;
        }
        .invoice-details {
            margin-top: 30px;
            border-top: 2px solid #ccc;
            border-bottom: 2px solid #ccc;
            padding: 20px 0;
        }
        .details-row {
            margin: 10px 0;
        }
        .details-label {
            font-weight: bold;
        }
        .invoice-items {
            margin-top: 30px;
        }
        .item-row {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }
        .item-description {
            font-weight: bold;
        }
        .item-quantity, .item-unit-price, .item-total {
            text-align: right;
        }
        .invoice-total {
            margin-top: 30px;
            font-size: 20px;
            text-align: right;
            font-weight: bold;
        }
        .footer-text {
            text-align: center;
            margin-top: 30px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h2>E-Dental</h2>
        </div>
        <div class="invoice-title">Invoice</div>
        <div class="invoice-details">
            <div class="details-row">
                <span class="details-label">Invoice Number:</span> INV-{{$appointment->date}}-{{$appointment->appointmentID}}
            </div>
            <div class="details-row">
                <span class="details-label">Issue Date:</span> {{$appointment->date}}
            </div>
        </div>
        <div class="invoice-items">
            <div class="item-row">
                <div class="row">
                    <div class="col-md-6">
                        <span class="item-description">Treatment Type</span><br>
                        {{$appointment->treatmentname}}
                    </div>
                    <div class="col-md-2 item-quantity">Rp. </div>
                    <div class="col-md-2 item-unit-price"></div>
                    <div class="col-md-2 item-total">{{ number_format($appointment->treatmentprice, 0, ',', '.') }}</div>
                </div>
            </div>
            <div class="item-row">
                <div class="row">
                    <div class="col-md-6">
                        <span class="item-description">Tax</span><br>
                        Services 
                    </div>
                    <div class="col-md-2 item-quantity">Rp. </div>
                    <div class="col-md-2 item-unit-price"></div>
                    <div class="col-md-2 item-total">{{ number_format($appointment->treatmentprice * 0.05, 0, ',', '.') }}</div>
                </div>
            </div>
            <!-- Add more rows for additional products -->
        </div>
        <div class="invoice-total">Total: Rp. {{ number_format($appointment->treatmentprice * 1.05, 0, ',', '.') }}</div>

        <div class="footer-text">Thank You for Choosing E-Dental - Your Smile Matters!</div>
    </div>

    <!-- Link Bootstrap and jQuery scripts at the end of the body for better performance -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
