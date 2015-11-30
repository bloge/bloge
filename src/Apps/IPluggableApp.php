<?php

namespace Bloge\Apps;

use Bloge\IPlugin;

/**
 * Pluggable application
 * 
 * Application that can be plugged with \Bloge\IPlugin
 * 
 * @package bloge
 */
interface IPluggableApp extends IApp
{
    /**
     * @return \Bloge\Content\Advanced
     */
    public function content();
    
    /**
     * @param \Bloge\IPlugin $plugin
     * @return \Bloge\IPluggableApp $this
     */
    public function plugin(IPlugin $plugin);
}