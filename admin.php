<?php
    $message = false;
    if (isset($_GET['action'])) {
        switch($_GET['action']) {
            case 'refresh':
                $time = date('Y-m-d-His');
                rename('raw', $time."-raw");
                rename('photos', $time."-photos");
                mkdir('raw');
                mkdir('photos');
                $message = "Filed moved to $time";
                break;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>El And Scotty</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div class="container">
    <?php if ($message):?>
    <div class="alert alert-success"><?=$message;?></div>
    <?php endif;?>
    <div class="row">
        <div class="col-xs-12">
            <a class="btn btn-warning btn-lg" style="width: 100%" href="?action=refresh">Refresh</a>
        </div>

    </div>
</div>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>
