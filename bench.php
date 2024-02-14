<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/functions.php';

use Tsybenko\PhpObjectsArrayVsGenerator\PluginExecutor;

function bytesToMegabytes(int $bytes, int $roundPrecision = 2): float {
    return round($bytes / (1024 * 1024), $roundPrecision);
}

function formatUsage(int $runtimeUsage, int $peakUsage): string
{
    return sprintf(
        '%.2f MB - %s = %.2f MB',
        bytesToMegabytes($peakUsage),
        'runtime usage',
        bytesToMegabytes($peakUsage - $runtimeUsage)
    );
}

memory_reset_peak_usage();
$runtimeMemory = memory_get_peak_usage();

echo ('Runtime usage: ' . sprintf('%.2f MB', bytesToMegabytes($runtimeMemory)) . PHP_EOL . PHP_EOL);

(new PluginExecutor(getPluginsArray()))->execute();
$arrayUsage = memory_get_peak_usage();
echo ('Array: ' . formatUsage($runtimeMemory, $arrayUsage) . PHP_EOL);

memory_reset_peak_usage();

(new PluginExecutor(getPluginsGenerator()))->execute();
$generatorUsage = memory_get_peak_usage();
echo ('Generator: ' . formatUsage($runtimeMemory, $generatorUsage) . PHP_EOL);
