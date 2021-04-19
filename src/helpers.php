<?php

if (! function_exists('metrics_asset')) {
    function metrics_asset($path, $secure = null)
    {
        return asset('vendor/metrics/'.$path, $secure);
    }
}
