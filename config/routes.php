<?php

return array(
    // show
    'show/index/([0-9]+)' => 'show/index/$1',
    // ticket
    'ticket/index/([0-9]+)' => 'ticket/index/$1',
    // order
    'order' => 'order/index',
    'order/index' => 'order/index',
    'order/view/([0-9]+)' => 'order/view/$1',
    'order/deleteOrderItem/([0-9]+)/([0-9]+)' => 'order/deleteOrderItem/$1/$2',
    'order/complete/([0-9]+)' => 'order/complete/$1',
    // user
    'user/signup' => 'user/signup',
    'user/signin' => 'user/signin',
    'user/signout' => 'user/signout',
    // about site
    'site/contact' => 'site/contact',
    'contacts' => 'site/contact',
    'site/about' => 'site/about',
    'about' => 'site/about',
    // index site
    '' => 'site/index',
    '/' => 'site/index', 
    'site' => 'site/index', 
    'site/index' => 'site/index', 
    'index.php' => 'site/index', 
    // error 404
    '404' => '404/index',
    '404/index' => '404/index',
);