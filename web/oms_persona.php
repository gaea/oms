<?php


require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('oms_persona', 'prod', false);
sfContext::createInstance($configuration)->dispatch();