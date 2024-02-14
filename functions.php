<?php

require_once __DIR__ . '/vendor/autoload.php';

use Tsybenko\PhpObjectsArrayVsGenerator\Plugin;

function getPluginsArray(): iterable {
	$plugins = [];

	$plugins[] = new Plugin();

	return $plugins;
}
function getPluginsGenerator(): iterable {
	yield new Plugin();

}
