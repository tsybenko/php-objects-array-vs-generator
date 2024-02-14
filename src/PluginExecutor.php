<?php

namespace Tsybenko\PhpObjectsArrayVsGenerator;

class PluginExecutor
{
    /**
     * @var iterable<Plugin>
     */
    protected iterable $plugins;

    public function __construct(iterable $plugins)
    {
        $this->plugins = $plugins;
    }

    public function execute(): void
    {
        foreach ($this->plugins as $plugin) {
            $plugin->execute()->getMessage() . PHP_EOL;
        }
    }
}
