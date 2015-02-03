<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
return array(
    
    'doctrine_config' => array(
        'driver' => 'pdo_sqlsrv',
        //'driver' => 'sqlsrv',
        'host' => 'localhost',
        'user' => 'mira',
        'password' => 'mira',
        'dbname' => 'DB_Mira'
    ),
     /*
    'db' => array(
        'driver' => 'pdo',
        'dsn' => 'sqlsrv:database=DB_Mira;Server=localhost',
        'charset' => 'UTF-8',
        'username' => 'mira',
        'password' => 'mira',
        'pdotype' => 'sqlsrv',
        'platform_options' => array('quote_identifiers' => false),
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),*/
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
            'Navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory'
        ),
    ),
);
