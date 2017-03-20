<?php
if (!file_exists('raw')) {
    mkdir('raw');
}
if (!file_exists('photos')) {
    mkdir('photos');
}
$config = parse_ini_file('config.ini');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?=$config['title'];?></title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        #countdown {
            display: none;
        }

        #text {
            color: #fff;
            font-size: 72px;
        }

        body {
            background-color: #d4d4d4;
            height: 100%;
        }

        .main {
            width: 70%;
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
        }

        .button {
            width: 30%;
            height: 100%;
            position: absolute;
            right: 0;
            top: 0;
            /*background-color: #53C7CE;*/
            background-color: <?=$config['touchColor']?>;
            padding: 20px;
            text-align: center;
        }

        .cycle-slideshow {
            width: 90%;
            margin: 0px auto;
            height: 90%;
            margin-top: 10%;
            overflow: hidden;
        }

        .cycle-slideshow img {
            width: 100%;
            height: auto
        }


    </style>
</head>
<body>

<div class="main">
    <div class="cycle-slideshow" data-cycle-timeout="3000" data-cycle-fx="scrollHorz" data-cycle-auto-height="4:3">

    </div>
</div>
<div class="button">
    <div id="countdown"></div>
    <img src="img/heart.gif" id="loader" style="display: none"/>
    <div id="text">Touch here to take a picture!</div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.countdown360.min.js"></script>
<script src="js/jquery.cycle2.min.js"></script>
<script>


    var $countdown = false;
    var counting_down = false;
    var images = [];
    $(function () {
        $countdown = $("#countdown").countdown360({
            radius: 120,
            seconds: <?=$config['delay']?>,
            fontColor: '#FFFFFF',
            fillStyle: '#000',
            strokeStyle: '#d4d4d4',
            smooth: true,
            autostart: false,
            onComplete: function () {

                $('#countdown').hide();
                $('#text').text('Getting your picture ready!');
                $("#loader").show();
                $.get('take_photo.php', function () {
                    getPhotos();
                }).always(function () {

                    stop_countdown();
                });

            }
        });
        $('.button').on('click', function () {
            if (counting_down) {
                //Cancel the countdown
                stop_countdown();
            } else {
                start_countdown();
                $('.cycle-slideshow').cycle('pause');
            }
        });

        getPhotos();
    });

    function start_countdown() {

        $('#countdown').show();
        $('#text').text("Please be patient");
        counting_down = true;
        $countdown.start();
    }

    function stop_countdown() {
        $countdown.stop();
        counting_down = false;


        setTimeout(function() {
            $('#text').text('Touch here to take a picture!');
            $("#loader").hide();
        }, 2000);
        $('#text').show();
    }
    function getPhotos() {
        $.getJSON('list_photos.php', function (photos) {

            for (var i in photos) {
                var photo = photos[i];
                if ($.inArray(photo, images) === -1) {
                    var tag = '<img src="photos/' + photo + '"/>';
                    $('.cycle-slideshow').cycle('add', tag);
                    images.push(photo);
                }
            }
            $('.cycle-slideshow').cycle('goto', images.length - 1);
            $('.cycle-slideshow').cycle('pause');
            setTimeout(function () {
                $('.cycle-slideshow').cycle('resume');
            }, 10000);

        });
    }

    function display(photo) {
        $('#image_1').attr('src', 'photos/' + photo);
    }
</script>
</body>
</html>
