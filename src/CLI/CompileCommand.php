<?php

namespace Bloge\CLI;

use Bloge\NotFoundException;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Compile command
 * 
 * Compiles application to destination directory.
 * 
 * @link http://symfony.com/doc/current/components/console/introduction.html
 * @package bloge
 */

class CompileCommand extends Command
{
    protected function configure()
    {
        $this->setName('compile')
            ->setDescription('Compile an application')
            ->addArgument(
                'app',
                InputArgument::REQUIRED,
                'Which application you want to build?'
            )
            ->addArgument(
                'destination',
                InputArgument::REQUIRED,
                'Where do you want your application to be built?'
            )
            ->addOption(
                'compiler',
                'c',
                InputOption::VALUE_REQUIRED,
                'Which compiler you want to use (specify class name)?',
                '\Bloge\Compilers\HTMLCompiler'
            );
    }
    
    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $destination = $input->getArgument('destination');
        $compiler    = $input->getOption('compiler');
        $app         = $input->getArgument('app');
        
        if (!is_file($app)) {
            $output->writeln("<error>'$app' isn't a file!</error>");
            
            return 1;
        }
        
        if (!class_exists($compiler)) {
            $output->writeln(
                "<error>Compiler class '$compiler' doesn't exists!</error>"
            );
            
            return 1;
        }
        
        /** Isolate scope */
        $callback = function () use ($app) {
            return require $app;
        };
        
        $application = $callback();
        $compiler = new $compiler($application);
        $compiler->isBuildable($destination);
        
        foreach ($application->browse() as $path) {
            try {
                $compiler->build($path, $destination);
                
                if ($output->isVerbose()) {
                    $output->writeln(
                        "<info>Content file '$path' was successfully compiled!</info>"
                    );
                }
            }
            catch (NotFoundException $e) {
                if ($output->isVerbose()) {
                    $output->writeln(
                        "<error>Content file by path '$path' wasn't found.</error>"
                    );
                }
            }
            catch (Exception $e) {
                throw $e;
            }
        }
        
        $output->writeln(
            "<info>Application '$app' was successfully compiled into '$destination'!</info>"
        );
    }
}