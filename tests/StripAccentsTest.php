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
// Time:     10:57
// Project:  StripAccents
//
declare(strict_types = 1);
namespace CodeInc\StripAccents\Tests;
use CodeInc\StripAccents\StripAccents;
use PHPUnit\Framework\TestCase;


/**
 * Class StripAccentsTest
 *
 * @package CodeInc\StripAccents\Tests
 * @author Joan Fabrégat <joan@codeinc.fr>
 */
class StripAccentsTest extends TestCase
{
    public const ACCENTS = [
        'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î',
        'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â',
        'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò',
        'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'];
    
    public const LETTERS = [
        'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I',
        'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a',
        'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'e', 'o',
        'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y'
    ];

    public function testOneByOne():void
    {
        foreach (self::ACCENTS as $key => $accent) {
            self::assertTrue(StripAccents::strip($accent) == self::LETTERS[$key]);
        }
    }

    public function testAll():void
    {
        self::assertTrue(
            StripAccents::strip(implode("", self::ACCENTS))
            == implode(self::LETTERS)
        );
    }
}