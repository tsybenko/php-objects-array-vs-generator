<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Tsybenko\PhpObjectsArrayVsGenerator\Plugin;

function renderFile(string $contents): string
{
    $template = '<?php' . "\n\n";
    $template .= 'require_once __DIR__ . \'/vendor/autoload.php\';' . "\n\n";
    $template .= sprintf('use %s;', Plugin::class) . "\n\n";
    $template .= $contents;

    return $template;
}

function renderFunction(string $functionName, string $funcDefinition, string $funcBody): string
{
    $renderedFunctionDefinition = str_replace('__FUNCTION_NAME__', $functionName, $funcDefinition);
    $renderedFunctionDefinition = str_replace('__FUNCTION_BODY__', $funcBody, $renderedFunctionDefinition);

    return $renderedFunctionDefinition;
}

function getFunctionDefinitionTemplate(): string
{
    return "function __FUNCTION_NAME__(): iterable {
__FUNCTION_BODY__
}
";
}

function getGeneratorFunctionBody(int $pluginsCount = 1): string
{
    $template = '';

    for ($i = 0; $i < $pluginsCount; $i++) {
        $template .= "\t" . 'yield new Plugin();' . "\n";
    }

    return $template;
}

function getArrayFunctionBody(int $pluginsCount = 1): string
{
    $template = "\t" . '$plugins = [];' . "\n\n";

    for ($i = 0; $i < $pluginsCount; $i++) {
        $template .=  "\t" . '$plugins[] = new Plugin();' . "\n";
    }

    $template .= "\n\t" . 'return $plugins;';

    return $template;
}

$pluginsCount = getenv('PLUGINS_COUNT') ?? 100;

$fileContents = renderFunction('getPluginsArray', getFunctionDefinitionTemplate(), getArrayFunctionBody($pluginsCount));
$fileContents .= renderFunction('getPluginsGenerator', getFunctionDefinitionTemplate(), getGeneratorFunctionBody($pluginsCount));

file_put_contents(
    __DIR__ . '/../functions.php',
    renderFile($fileContents)
);

