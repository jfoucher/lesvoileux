<?php

namespace Voileux\CoreBundle\Util;

class String
{
    static public function constantTimeCompare($a, $b)
    {
        if (strlen($a) !== $c = strlen($b)) {
            return false;
        }

        $result = 0;
        for ($i = 0; $i < $c; $i++) {
            $result |= ord($a[$i]) ^ ord($b[$i]);
        }

        return 0 === $result;
    }

    public static function slug($str, $separator = '_')
    {
        $q_separator = preg_quote($separator, '#');

        $trans = array(
            '&.+?;'			=> '',
            '[^a-z0-9 _-]'		=> '',
            '\s+'			=> $separator,
            '('.$q_separator.')+'	=> $separator
        );

        $str = strip_tags($str);
        foreach ($trans as $key => $val)
        {
            $str = preg_replace('#'.$key.'#i', $val, $str);
        }

        $str = strtolower($str);


        return trim(trim($str, $separator));
    }

    public static function generateToken()
    {
        $bytes = false;
        if (function_exists('openssl_random_pseudo_bytes') && 0 !== stripos(PHP_OS, 'win')) {
            $bytes = openssl_random_pseudo_bytes(32, $strong);

            if (true !== $strong) {
                $bytes = false;
            }
        }

        // let's just hope we got a good seed
        if (false === $bytes) {
            $bytes = hash('sha256', uniqid(mt_rand(), true), true);
        }

        return base_convert(bin2hex($bytes), 16, 36);
    }
}
