<?php

namespace Gtrig\NestableTree;

use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class NestableTree extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('nestable-tree', __DIR__.'/../dist/js/tool.js');
        Nova::style('nestable-tree', __DIR__.'/../dist/css/tool.css');
    }

    /**
     * Build the menu that renders the navigation links for the tool.
     *
     * @param  \Illuminate\Http\Request $request
     * @return mixed
     */
    public function menu(Request $request)
    {
        // load configuration
        $config = config('nestable-tree');
        
        foreach ($config['sortable_resources'] as $label => $resource) {
            $items[] = MenuItem::externalLink(
                $resource['label'],
                '/nova/nestable-tree/reorder/'.$resource['link']
            );
        }

        $menu = MenuSection::make('Reorder', $items)
            ->icon('server');

        

        return $menu;
    }
}
