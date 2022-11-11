<?php

namespace App\Services;

use App\Models\Proxy;

class ProxyService
{
    /**
     * Normalization data to send
     *
     * @param String $format
     * @return Array
     */
    public static function normalizationData($format)
    {
        $list = Proxy::get();

        /* Match 192.168.0.1 */
        preg_match("/^(25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$/im", $format, $match);
        if(!empty($match[0]))
        {
            $collection = $list->map(function ($item) {
                return $item->ip;
            });

            return $collection->toArray();
        } else {
            /* Match 192.168.0.1:25 */
            preg_match("/^(25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}((?:\:\d+){1})$/im", $format, $match);

            if(!empty($match[0]))
            {
                $collection = $list->map(function ($item) {
                    return $item->ip . ":" . $item->port;
                });

                return $collection->toArray();
            } else {
                /* Match 192.168.0.1@login:password */
                preg_match("/^(25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}((?:\@\w+\:\w+){1})$/im", $format, $match);

                if(!empty($match[0]))
                {
                    $collection = $list->map(function ($item) {
                        return $item->ip . "@" . $item->login . ":" . $item->password;
                    });

                    return $collection->toArray();
                } else {
                    /* Match 192.168.0.1:25@login:password */
                    $collection = $list->map(function ($item) {
                        return $item->ip . ":" . $item->port . "@" . $item->login . ":" . $item->password;
                    });

                    return $collection->toArray();
                }
            }
        }
    }
}
