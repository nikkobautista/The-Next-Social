<?php
/**
 * Doctrine CLI script
 *
 * @author Juozas Kaziukenas (juozas@juokaz.com)
 */

define('APPLICATION_ENV', 'development');
define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    './',
    get_include_path(),
)));

require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

$application->getBootstrap()->bootstrap('doctrine');

// set aggressive loading to make sure migrations are working
Doctrine_Manager::getInstance()->setAttribute(
    Doctrine::ATTR_MODEL_LOADING,
    Doctrine_Core::MODEL_LOADING_AGGRESSIVE
);

$options = $application->getBootstrap()->getOptions();

$cli = new Doctrine_Cli($options['doctrine']);

$cli->run($_SERVER['argv']);