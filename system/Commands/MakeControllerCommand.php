<?php

namespace System\Commands;

class MakeControllerCommand
{
    public function getName()
    {
        return 'make:controller';
    }

    public function execute()
    {
        global $argv;

        if (count($argv) < 3) {
            echo "Usage: php artisan make:controller [dir/ControllerName]\n";
            exit(1);
        }

        $controllerPath = $argv[2];
        $controllerParts = explode('/', $controllerPath);
        $controllerName = array_pop($controllerParts);
        $controllerDir = __DIR__ . '/../../Controllers/' . implode('/', $controllerParts);
        $controllerFile = $controllerDir . '/' . $controllerName . '.php';

        if (!file_exists($controllerDir)) {
            mkdir($controllerDir, 0777, true);
        }

        if (file_exists($controllerFile)) {
            echo "Controller already exists.\n";
            exit(1);
        }

        $namespace = 'App\\Controllers';
        if (!empty($controllerParts)) {
            $namespace .= '\\' . implode('\\', $controllerParts);
        }

        $template = <<<EOT
<?php

namespace $namespace;

use App\Controllers\Controller;

class $controllerName extends Controller
{
   /**
    * Write your controller code here
    */
}
EOT;

        file_put_contents($controllerFile, $template);
        echo "Controller created successfully: $controllerFile\n";
    }
}
