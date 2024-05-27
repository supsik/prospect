<?php

return new \Phalcon\Config(array(
        'database' => array(
                'adapter'     => 'Mysql',
                'host'        => 'mysql',
                'username'    => 'root',
                'password'    => 'root',
                'dbname'      => 'prospect'
        ),
        'application' => array(
                'appDir'         => ROOT . '/app/',
                'controllersDir' => ROOT . '/app/controllers/',
                'modelsDir'      => ROOT . '/app/models/',
                'viewsDir'       => ROOT . '/app/views/',
                'pluginsDir'     => ROOT . '/app/plugins/',
                'libraryDir'     => ROOT . '/app/library/',
                'cacheDir'       => ROOT . '/app/cache/',
                'configDir'      => ROOT . '/app/config/',
                'baseUri'        => '/',
        )
));
