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
     * @return \Bloge\Content\Advanced
     */
    public function content();
    
    /**
     * @param \Bloge\Plugin $plugin
     * @return \Bloge\PluggableApp $this
     */
    public function plugin(Plugin $plugin);
}