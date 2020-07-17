<?php
//
// +---------------------------------------------------------------------+
// | CODE INC. SOURCE CODE                                               |
// +---------------------------------------------------------------------+
// | Copyright (c) 2017 - Code Inc. SAS - All Rights Reserved.           |
// | Visit https://www.codeinc.fr for more information about licensing.  |
// +---------------------------------------------------------------------+
// | NOTICE:  All information contained herein is, and remains the       |
// | property of Code Inc. SAS. The intellectual and technical concepts  |
// | contained herein are proprietary to Code Inc. SAS are protected by  |
// | trade secret or copyright law. Dissemination of this information or |
// | reproduction of this material  is strictly forbidden unless prior   |
// | written permission is obtained from Code Inc. SAS.                  |
// +---------------------------------------------------------------------+
//
// Author:   Joan Fabrégat <joan@codeinc.fr>
// Date:     15/03/2018
// Time:     10:52
// Project:  StipAccents
//
declare(strict_types = 1);
namespace CodeInc\StripAccents;


/**
 * Class StripAccents
 *
 * @link http://www.infowebmaster.fr/tutoriel/php-enlever-accents
 * @package CodeInc\StripAccents
 * @author Joan Fabrégat <joan@codeinc.fr>
 */
class StripAccents
{
    public const DEFAULT_ENCODING = 'utf-8';

    /**
     * @param string $string
     * @param string $encoding
     * @return string
     */
    public static function strip(string $string, $encoding = self::DEFAULT_ENCODING):string
    {
        // converting accents in HTML entities
        $string = htmlentities($string, ENT_NOQUOTES, $encoding);

        // replacing the HTML entities to extract the first letter
        // examples: "&ecute;" => "e", "&Ecute;" => "E", "à" => "a" ...
        $string = preg_replace(
            '#&([A-za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#',
            '\1',
            $string
        );

        // replacing ligatures
        // Exemple "œ" => "oe", "Æ" => "AE"
        $string = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $string);

        // removing the remaining bits
        $string = preg_replace('#&[^;]+;#', '', $string);

        return $string;
    }

    /**
     * @param string $string
     * @param string $encoding
     * @param string $replaceWith
     * @return string
     */
    public static function stripNonPrint(string $string,
                                         string $replaceWith = '',
                                         string $encoding = self::DEFAULT_ENCODING): string
    {
        return preg_replace('/[[:^print:]]/', $replaceWith, self::strip($string, $encoding));
    }
}