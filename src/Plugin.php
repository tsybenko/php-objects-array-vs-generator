<?php

namespace Tsybenko\PhpObjectsArrayVsGenerator;

class Plugin
{
    public const MESSAGE_TEMPLATE = '%s has been executed';

    protected function createResponse(): PluginExecutionResponse
    {
        return (new PluginExecutionResponse())
            ->setMessage(sprintf(static::MESSAGE_TEMPLATE, static::class));
    }

    public function execute(): PluginExecutionResponse
    {
        return $this->createResponse();
    }
}
