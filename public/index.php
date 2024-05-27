<?php
error_reporting(0);

/**
 * CONSTATNTS
 */
define('ROOT', rtrim(__DIR__ . '/../','/'));

try
{

    /**
     * Read the configuration
     */
    $config = include ROOT . "/app/config/config.php";

    /**
     * Read auto-loader
     */
    include ROOT . "/app/config/loader.php";

    /**
     * Read services
     */
    include ROOT . "/app/config/services.php";

    /**
     * Composer
     */
    if(file_exists(ROOT . '/vendor/autoload.php'))
    {
        require ROOT . '/vendor/autoload.php';
    }

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

}
catch(\Exception $e)
{
    echo $e->getMessage();
}
