<?php

return array(
    // show
    'show' => 'show/index',
    'show/index' => 'show/index',
    'show/create' => 'show/create',
    'show/film/([0-9]+)' => 'show/film/$1',
    'show/view/([0-9]+)' => 'show/view/$1',
    'show/update/([0-9]+)' => 'show/update/$1',
    // order item
    'orderItem/index/([0-9]+)' => 'orderItem/index/$1',
    'orderItem/delete/([0-9]+)/([0-9]+)' => 'orderItem/delete/$1/$2',
    // order
    'order' => 'order/index',
    'order/index' => 'order/index',
    'order/view/([0-9]+)' => 'order/view/$1',
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
    'film/create' => 'film/create',
    'film/view/([0-9]+)' => 'film/view/$1',
    'film/update/([0-9]+)' => 'film/update/$1',
    // theater
    'theater' => 'theater/index',
    'theater/index' => 'theater/index',
    'theater/view/([0-9]+)' => 'theater/view/$1',
    // theater hall
    'theaterHall' => 'theaterHall/index',
    'theaterHall/index' => 'theaterHall/index',
    'theaterHall/view/([0-9]+)' => 'theaterHall/view/$1',
    'hall' => 'theaterHall/index',
    'hall/index' => 'theaterHall/index',
    'hall/view/([0-9]+)' => 'theaterHall/view/$1',

);