<?php

namespace Bloge;

/**
 * Pluggable application
 * 
 * Application that can be plugged with \Bloge\Plugin
 * 
 * @package Bloge
 */
interface PluggableApp extends App
{
    /**
     * @return \Bloge\Content
     */
    public function content();
    
    /**
     * @return \Bloge\DataMapper
     */
    public function dataMapper();
    
    /**
     * @return \Bloge\Dispatcher
     */
    public function dispatcher();
    
    /**
     * @return \Bloge\Processor
     */
    public function processor();
    
    /**
     * @param \Bloge\Plugin $plugin
     * @return \Bloge\PluggableApp $this
     */
    public function plugin(Plugin $plugin);
}