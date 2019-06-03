#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__ . '/AvantiMenuCommand.php';
require __DIR__.'/Classes/Satellite.php';

use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new AvantiMenuCommand());
$application->run();
