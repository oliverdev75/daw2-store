<?php

/* Global */

define('PROJECT_ROOT', join(DIRECTORY_SEPARATOR, array_slice(explode(DIRECTORY_SEPARATOR, __DIR__), 0, count(explode(DIRECTORY_SEPARATOR, __DIR__)) - 1)));

/* Views */

define('VIEWS_PATH', PROJECT_ROOT.'/views');
define('VIEWS_TEMPLATE', '/template');
define('VIEWS_LAYOUT_DIR', '/layout');

/* Assets */

define('ASSETS_PATH', '/assets');

/* Routes */

define('API_PREFIX', '/api');
