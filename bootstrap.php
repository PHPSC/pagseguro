<?php

$autoloader = require __DIR__ . '/vendor/autoload.php';

Doctrine\Common\Annotations\AnnotationRegistry::registerLoader([$autoloader, 'loadClass']);
