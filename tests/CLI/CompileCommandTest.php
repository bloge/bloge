<?php

namespace Bloge\CLI;

use Symfony\Component\Console\Tester\CommandTester;

class CompileCommandTest extends \TestCase
{
    public function executeTester($app, $destination, $compiler = '')
    {
        $args = compact('app', 'destination');
        
        if ($compiler) {
            $args['-c'] = $compiler;
        }
        
        $command = new CompileCommand;
        
        $commandTester = new CommandTester($command);
        $commandTester->execute($args);
        
        return $commandTester;
    }
    
    public function assertTester($regex, $app, $destination, $compiler = '')
    {
        $this->assertRegExp(
            $regex, 
            $this->executeTester($app, $destination, $compiler)->getDisplay()
        );
    }
    
    public function testSuccesfulBuild()
    {
        $this->assertTester(
            '/was successfully compiled into/', 
            MAIN_DIR . '/app.php', 
            BUILD_DIR
        );
    }
    
    public function testFailedBuildNoAppFound()
    {
        $this->assertTester(
            '/isn\'t a file!/', 
            MAIN_DIR . '/.php', 
            BUILD_DIR
        );
    }
    
    public function testFailedBuildNoCompilerFound()
    {
        $this->assertTester(
            '/Compiler class/', 
            MAIN_DIR . '/app.php', 
            BUILD_DIR,
            '\Bloge\Compilers\FooCompiler'
        );
    }
}