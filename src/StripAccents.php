<?php

declare(strict_types=1);

namespace CodeInc\StripAccents;

/**
 * Removes accents and diacritics from strings.
 */
class StripAccents
{
    private const string DEFAULT_ENCODING = 'utf-8';

    /**
     * Strips accents and diacritics from a string.
     */
    public static function strip(string $string, string $encoding = self::DEFAULT_ENCODING): string
    {
        $string = htmlentities($string, ENT_NOQUOTES, $encoding);

        // replace accented HTML entities with their base letter
        // e.g. "&eacute;" => "e", "&Eacute;" => "E", "&agrave;" => "a"
        $string = preg_replace(
            '#&([A-Za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#',
            '\1',
            $string
        );

        // replace ligatures e.g. "&oelig;" => "oe", "&AElig;" => "AE"
        $string = preg_replace('#&([A-Za-z]{2})(?:lig);#', '\1', $string);

        // remove any remaining HTML entities
        $string = preg_replace('#&[^;]+;#', '', $string);

        return $string;
    }

    /**
     * Strips accents and non-printable characters from a string.
     */
    public static function stripNonPrint(
        string $string,
        string $replaceWith = '',
        string $encoding = self::DEFAULT_ENCODING,
    ): string {
        return preg_replace('/[[:^print:]]/', $replaceWith, self::strip($string, $encoding));
    }
}
