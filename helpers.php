<?php

if (! function_exists('package')) {
    function package($name) {
        return sprintf('bus-router-sg::%s', $name);
    }
}

if (! function_exists('if_route_match')) {
    function if_route_match($name, $then, $else = null) {
        return Route::currentRouteName() === route(package($name)) ? $then : $else;
    }
}
