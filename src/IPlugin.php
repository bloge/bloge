<?php

namespace Bloge;

use Bloge\Apps\IPluggableApp;

/**
 * Plugin interface
 * 
 * Implementation of interface is responsible for registering different filters, 
 * maps, and map data.
 * 
 * @package bloge
 */
interface IPlugin
{
    /**
     * @param \Bloge\IPluggableApp $app
     */
    public function register(IPluggableApp $app);
}