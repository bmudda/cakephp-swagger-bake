<?php
declare(strict_types=1);

namespace SwaggerBake\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;

/**
 * Class InstallCommand
 * @package SwaggerBake\Command
 */
class InstallCommand extends Command
{
    /**
     * Installer
     *
     * @param Arguments $args
     * @param ConsoleIo $io
     * @return int|void|null
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $io->hr();
        $io->out("| SwaggerBake Install");
        $io->hr();

        $io->info('This will create, but not overwrite config/swagger.yml and config/swagger_bake.php');

        $io->out(
            'If your API exists in a plugin or you have some other non-standard setup, please follow ' .
            'the manual installation steps.'
        );

        if (strtoupper($io->ask('Continue?', 'Y')) !== 'Y') {
            return;
        }

        $assets = __DIR__ . DS . '..' . DS . '..' . DS  . 'assets';
        if (!dir($assets)) {
            $io->error('Unable to locate assets directory, please install manually');
            return;
        }

        if (file_exists(CONFIG . 'swagger.yml') || file_exists(CONFIG . 'swagger_bake.php')) {
            $answer = $io->ask('The installer found existing SwaggerBake config files. Overwrite?', 'Y');
            if (strtoupper($answer) !== 'Y') {
                return;
            }
        }

        do {
            $path = $io->ask('What is your relative API path (e.g. /api)');
            if (empty($path) || !filter_var('http://localhost' . $path, FILTER_VALIDATE_URL)) {
                $io->warning('You must enter a valid API path');
                unset($path);
            }
        }
        while (!isset($path));

        if (!copy("$assets/swagger.yml", CONFIG . 'swagger.yml')) {
            $io->error('Unable to copy swagger.yml, check permissions');
            return;
        }

        if (!copy("$assets/swagger_bake.php", CONFIG . 'swagger_bake.php')) {
            $io->error('Unable to copy swagger_bake.php, check permissions');
            return;
        }

        $contents = file_get_contents(CONFIG . 'swagger.yml');
        $contents = str_replace('YOUR-SERVER-HERE', $path, $contents);
        file_put_contents(CONFIG . 'swagger.yml', $contents);

        $contents = file_get_contents(CONFIG . 'swagger_bake.php');
        $contents = str_replace('/your-relative-api-url', $path, $contents);
        file_put_contents(CONFIG . 'swagger_bake.php', $contents);

        $io->success('Installation Complete!');

        $io->out('Now just add a route in your config/routes.php for SwaggerUI and you\'re ready to go!');
    }
}
