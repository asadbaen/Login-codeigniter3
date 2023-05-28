<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>404 Page Not Found</title>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <style type="text/css">
        ::selection {
            background-color: #E13300;
            color: white;
        }

        ::-moz-selection {
            background-color: #E13300;
            color: white;
        }

        body {
            background-color: #fff;
            margin: 40px;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
        }

        a {
            color: #003399;
            font-weight: bold;
            text-transform: uppercase;
        }

        p {
            text-align: center;
            padding-top: 20px;
        }

        h1 {
            color: #444;
            background-color: transparent;
            font-size: 80px;
            font-weight: bold;
            margin: 20px 0 14px 0;
            padding: 14px 15px 10px 15px;
            text-align: center;
        }

        h2 {
            text-align: center;
            color: #E13300;
            background-color: transparent;
            font-size: 80px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 50px 0 14px 0;
            padding: 14px 15px 10px 15px;
        }

        code {
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 12px;
            background-color: #f9f9f9;
            border: 1px solid #D0D0D0;
            color: #002166;
            display: block;
            margin: 14px 0 14px 0;
            padding: 12px 10px 12px 10px;
        }

        #container {
            margin: 10px;
            border: 1px solid #D0D0D0;
            box-shadow: 0 0 8px #D0D0D0;
        }

        p {
            margin: 12px 15px 12px 15px;
        }
    </style>
</head>

<body>
    <div id="container">
        <h1>404</h1>
        <hr>
        </hr>
        <h2>Page Not Found</h2>
        <p>The page you requested was not found.</p>

        <br>
        <p class="text-center"><a href="<?= base_url('Auth'); ?>"><i class="fas fa-long-arrow-alt-left"></i> Back to Dashboard !!!</a></p>
    </div>
</body>

</html>