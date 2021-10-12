<?php

spl_autoload_register(function ($cls) {
    $map = [
       'SMTP' => __DIR__.'/SMTP.php',
    ];

    if (isset($map[$cls])) {
        include $map[$cls];
        return true;
    }
}, true, true);
