<?php

if (! function_exists('route_name')) {
    function route_name($name) {
        return sprintf('bus-router-sg::%s', $name);
    }
}
