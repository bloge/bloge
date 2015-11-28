<?php

namespace Bloge;

/**
 * Plugin interface
 * 
 * Implementation of interface is responsible for registering different filters, 
 * maps, and map data.
 * 
 * @package Bloge
 */
interface Plugin
{
    /**
     * @param \Bloge\PluggableApp $app
     */
    public function register(PluggableApp $app);
}