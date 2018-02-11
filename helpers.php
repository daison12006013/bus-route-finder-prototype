<?php

if (! function_exists('package')) {
    function package($name, $type = null) {
        switch ($type) {
            case 'middleware':
                return sprintf('bus-router-sg-%s', $name);
                break;

            default:
                return sprintf('bus-router-sg::%s', $name);
                break;
        }

    }
}

if (! function_exists('if_route_match')) {
    function if_route_match($name, $then, $else = null) {
        return Route::currentRouteName() === package($name) ? $then : $else;
    }
}

function random_badge($records) {
    return collect($records)->map(function ($record) {
        $badges = ['success', 'info', 'primary', 'danger', 'dark'];

        return sprintf('<span class="badge badge-%s">%s</span>', $badges[array_rand($badges)], $record);
    })->all();
}
