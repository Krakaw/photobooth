<?php
$config = parse_ini_file('config.ini', true);

$gphoto2 = $config['shell']['gphoto2'];
$base = __DIR__;
shell_exec('sudo ./take_photo.sh "'.$gphoto2.'" "'.$base.'"');