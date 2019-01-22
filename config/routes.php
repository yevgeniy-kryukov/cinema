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
    // contact site
    'site/contact' => 'site/contact',
    'contacts' => 'site/contact',
    // about site
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
    // test
    'test' => 'test/index',
    'test/index' => 'test/index',
    // admin
    'admin' => 'admin/index',
    'admin/index' => 'admin/index',
    // film
    'film' => 'film/index',
    'film/index' => 'film/index',
    'film/view/([0-9]+)' => 'film/view/$1',
    // theater
    'theater' => 'theater/index',
    'theater/index' => 'theater/index',
    'theater/view/([0-9]+)' => 'theater/view/$1'

);