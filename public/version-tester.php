<?php

$alias = 'videojs';

$libinfo = include(dirname(__DIR__) . "/libs/{$alias}.php");

var_dump($libinfo);

echo $libinfo['version']();
