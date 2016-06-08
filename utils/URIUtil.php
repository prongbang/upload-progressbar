<?php

/**
 * Description of URI
 *
 * @author ex4
 */

include_once 'configs/config.php';

class URIUtil
{

    public static function curPageURL()
    {
        return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";;
    }

    public static function host()
    {
        if (MODE == PRODUCTION) {
            // @Host
            return "http://$_SERVER[HTTP_HOST]";
        } else {
            // @Local
            return "http://$_SERVER[HTTP_HOST]/" . APP_NAME;
        }
    }

}
