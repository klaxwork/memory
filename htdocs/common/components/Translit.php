<?php

namespace common\components;

class Translit
{

    /**
     * @var string[] Replace list. Most friendly with Google and Yandex.
     */
    private static $_chr = [

        '0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4',
        '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9',

        'a' => 'a', 'b' => 'b', 'c' => 'c', 'd' => 'd', 'e' => 'e',
        'f' => 'f', 'g' => 'g', 'h' => 'h', 'i' => 'i', 'j' => 'j',
        'k' => 'k', 'l' => 'l', 'm' => 'm', 'n' => 'n', 'o' => 'o',
        'p' => 'p', 'q' => 'q', 'r' => 'r', 's' => 's', 't' => 't',
        'u' => 'u', 'v' => 'v', 'w' => 'w', 'x' => 'x', 'y' => 'y',
        'z' => 'z',

        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
        'е' => 'e', 'ё' => 'e', 'ж' => 'j', 'з' => 'z', 'и' => 'i',
        'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
        'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts', 'ч' => 'ch',
        'ш' => 'sh', 'щ' => 'shh', 'ъ' => '', 'ы' => 'y', 'ь' => '',
        'э' => 'e', 'ю' => 'u', 'я' => 'ya',

        '-' => '-', ' ' => '-', '.' => '-', ',' => '-',

    ];

    private static $_replace = [
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
        'е' => 'e', 'ё' => 'e', 'ж' => 'j', 'з' => 'z', 'и' => 'i',
        'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
        'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts', 'ч' => 'ch',
        'ш' => 'sh', 'щ' => 'shh', 'ъ' => '', 'ы' => 'y', 'ь' => '',
        'э' => 'e', 'ю' => 'u', 'я' => 'ya',

        '-' => '-', ' ' => '-', '.' => '-', ',' => '-',
    ];

    public static function text($text)
    {
        $text = mb_strtolower($text);

        //cyrilic and symbols translit
        $replace = self::$_replace;
        $s = '';
        for ($i = 0; $i < mb_strlen($text); $i++) {
            $c = mb_substr($text, $i, 1);
            if (array_key_exists($c, $replace)) {
                $s .= $replace[$c];
            } else {
                $s .= $c;
            }
        }

        //other translit

        //remove symbols
        $s = preg_replace('/[^\-0-9a-z]+/i', '', $s);

        //make shure that you set locale for using iconv
        $s = iconv('UTF-8', 'ASCII//TRANSLIT', $s);

        //double spaces
        $s = preg_replace('/\-+/', '-', $s);

        //spaces at begin and end
        $s = preg_replace('/^\-*(.*?)\-*$/', '$1', $s);

        return $s;
    }

}

