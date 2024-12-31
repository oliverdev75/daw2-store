<?php

/* Global */

define('APP_URL', 'http://localhost:3000');

define('PROJECT_ROOT', join(DIRECTORY_SEPARATOR, array_slice(explode(DIRECTORY_SEPARATOR, __DIR__), 0, count(explode(DIRECTORY_SEPARATOR, __DIR__)) - 1)));

/* Views */

define('VIEWS_PATH', PROJECT_ROOT . '/views');
define('VIEWS_LAYOUT_DIR', '/layout');
define('VIEWS_CLIENT_TEMPLATE', '/client/template');
define('VIEWS_ADMIN_TEMPLATE', '/admin/template');

/* Assets */

define('ASSETS_PATH', '/assets');

/* Routes */

define('API_PREFIX', '/api');

/* Storage */

define('STORAGE', '/storage');

/* Database */

define('DB_HOST', '127.0.0.1');
define('DB_PORT', 3333);
define('DB_USER', 'restaurant');
define('DB_PASSWORD', 'P@ssw0rd');
define('DB_NAME', 'restaurant');
define('DB_SOCKET', '/var/lib/mysql/mysql.sock');
