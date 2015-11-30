<?php

namespace Bloge\CLI;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Compile commands
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
        
        $compiler = new $compiler($callback());
        $compiler->build($destination);
        
        $output->writeln(
            "<info>Application '$app' was successfully compiled into '$destination'!</info>"
        );
    }
}