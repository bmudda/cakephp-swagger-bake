<?php
declare(strict_types=1);

namespace SwaggerBake\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Core\Configure;
use Cake\Routing\Router;
use InvalidArgumentException;
use SwaggerBake\Lib\CakeRoute;
use SwaggerBake\Lib\Configuration;
use SwaggerBake\Lib\Utility\ValidateConfiguration;

/**
 * Class RouteCommand
 * @package SwaggerBake\Command
 */
class RouteCommand extends Command
{
    use CommandTrait;

    /**
     * List Cake Routes that can be added to Swagger. Prints to console.
     *
     * @param Arguments $args
     * @param ConsoleIo $io
     * @return int|void|null
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $this->loadConfig();

        $io->hr();
        $io->out("| SwaggerBake is checking your routes...");
        $io->hr();

        $output = [
            ['Route name', 'URI template', 'Method(s)', 'Controller', 'Action', 'Plugin'],
        ];

        $config = new Configuration();
        ValidateConfiguration::validate($config);
        $prefix = $config->getPrefix();
        $cakeRoute = new CakeRoute(new Router(), $config);
        $routes = $cakeRoute->getRoutes();

        if (empty($routes)) {
            $io->out();
            $io->warning("No routes were found for: $prefix");
            $io->out("Have you added RESTful routes? Do you have models associated with those routes?");
            $io->out();
            return;
        }

        foreach ($routes as $route) {
            $output[] = [
                $route->getName(),
                $route->getTemplate(),
                implode(', ', $route->getMethods()),
                $route->getController(),
                $route->getAction(),
                $route->getPlugin(),
            ];
        }

        $io->helper('table')->output($output);
    }
}
