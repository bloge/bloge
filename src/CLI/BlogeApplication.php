<?php

namespace Bloge\CLI;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;

/**
 * BlogeApplication
 * 
 * @link http://symfony.com/doc/current/components/console/single_command_tool.html
 * @package Bloge
 */
class BlogeApplication extends Application
{
    /**
     * @param InputInterface $input
     * @return string
     */
    protected function getCommandName(InputInterface $input)
    {
        return 'compile';
    }

    /**
     * @return array
     */
    protected function getDefaultCommands()
    {
        $defaultCommands = parent::getDefaultCommands();
        $defaultCommands[] = new CompileCommand;

        return $defaultCommands;
    }

    /**
     * @return InputDefinition
     */
    public function getDefinition()
    {
        $inputDefinition = parent::getDefinition();
        $inputDefinition->setArguments();

        return $inputDefinition;
    }
}