<?php

if (!function_exists('dateintl_time')) {

    /**
     * Generate a international date string
     *
     * @param $type
     * @param $dateObject
     * @return string
     */
    function dateintl_time($dateObject, $withSeconds = false)
    {
        return app('dateintl')->time($dateObject, $withSeconds);
    }
}

if (!function_exists('dateintl_date')) {

    /**
     * Generate a international date string
     *
     * @param $type
     * @param $dateObject
     * @return string
     */
    function dateintl_date($type, $dateObject)
    {
        return app('dateintl')->date($type, $calendar, $dateObject);
    }

}

if (!function_exists('dateintl_full')) {

    /**
     * Generate a international date string
     *
     * @param $type
     * @param $dateObject
     * @return string
     */
    function dateintl_full($type, $dateObject, $withSeconds = false)
    {
        return app('dateintl')->full($type, $calendar, $dateObject, $withSeconds);
    }
}
