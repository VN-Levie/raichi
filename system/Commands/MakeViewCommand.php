<?php

namespace System\Commands;
class MakeViewCommand
{
    public function getName()
    {
        return 'make:view';
    }

    public function execute()
    {
        global $argv;

        if (count($argv) < 3) {
            echo "Usage: php artisan make:view dir/viewName\n";
            exit(1);
        }

        $viewPath = $argv[2];
        $viewDir = __DIR__ . '../../../../resources/views/' . dirname($viewPath);
        $viewFile = $viewDir . '/' . basename($viewPath) . '.blade.php';

        if (!file_exists($viewDir)) {
            mkdir($viewDir, 0777, true);
        }

        if (file_exists($viewFile)) {
            echo "View already exists.\n";
            exit(1);
        }

        $template = <<<EOT
{{-- Your view code here --}}
EOT;

        file_put_contents($viewFile, $template);
        echo "View created successfully: \n$viewPath\n";
    }
}
