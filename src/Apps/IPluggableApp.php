<?php

namespace Bloge\Apps;

use Bloge\IPlugin;

/**
 * Pluggable application
 * 
 * Application that can be plugged with \Bloge\Plugin
 * 
 * @package Bloge
 */
interface IPluggableApp extends IApp
{
    /**
     * @return \Bloge\Content\Advanced
     */
    public function content();
    
    /**
     * @param \Bloge\Plugin $plugin
     * @return \Bloge\PluggableApp $this
     */
    public function plugin(IPlugin $plugin);
}