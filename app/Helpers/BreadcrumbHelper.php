<?php

namespace App\Helpers;

class BreadcrumbHelper
{
    // Static function to return breadcrumbs based on route names
    public static function getBreadcrumbs()
    {
        // Define an array with routes and their corresponding titles/modules
        $routes = [
            'dashboard' => ['Dashboard', 'Main'],
            'users.index' => ['Users Management', 'User Module'],
            'products.index' => ['Products', 'Inventory'],
            'orders.index' => ['Orders', 'Sales Module'],
        ];

        // Get the current route name
        $currentRoute = request()->route()->getName();

        // Return the title and module based on the current route
        return $routes[$currentRoute] ?? ['Unknown Page', 'Unknown Module'];
    }
}
