<?php

namespace Bloge\Apps;

use Bloge\IPlugin;

/**
 * Pluggable application
 * 
 * Application that can be extended with plugins, dispatcher, datamapper, and 
 * processor.
 * 
 * @package bloge
 */

interface IPluggableApp extends IApp
{
    /**
     * @return \Bloge\Content\IAdvanced
     */
    public function content();
    
    /**
     * @param \Bloge\IPlugin $plugin
     * @return \Bloge\IPluggableApp $this
     */
    public function plugin(IPlugin $plugin);
}