<?php
//định nghĩa ROOT_PATH
define('ROOT_PATH', __DIR__);
//định nghĩa CACHE_VIEW
define('CAHCE_VIEW', true);
// upload path
define('UPLOAD_PATH', ROOT_PATH . '/uploads/');
//domain
define('DOMAIN', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']);