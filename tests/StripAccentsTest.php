<?php

declare(strict_types=1);

namespace CodeInc\StripAccents\Tests;

use CodeInc\StripAccents\StripAccents;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class StripAccentsTest extends TestCase
{
    private const ACCENT_MAP = [
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
        'Ç' => 'C',
        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
        'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
        'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O',
        'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U',
        'Ý' => 'Y',
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a',
        'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e',
        'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
        'ð' => 'e',
        'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o',
        'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u',
        'ý' => 'y', 'ÿ' => 'y',
    ];

    public static function accentProvider(): iterable
    {
        foreach (self::ACCENT_MAP as $accented => $expected) {
            yield $accented => [$accented, $expected];
        }
    }

    #[DataProvider('accentProvider')]
    public function testIndividualAccent(string $accented, string $expected): void
    {
        $this->assertSame($expected, StripAccents::strip($accented));
    }

    public function testAllAccentsConcatenated(): void
    {
        $input = implode('', array_keys(self::ACCENT_MAP));
        $expected = implode('', array_values(self::ACCENT_MAP));
        $this->assertSame($expected, StripAccents::strip($input));
    }

    public function testSentence(): void
    {
        $this->assertSame(
            "C'est une super chaine de caracteres avec beaucoup d'accents",
            StripAccents::strip("C'est une super chaîne de caractères avec beaucoup d'accents"),
        );
    }

    public function testAsciiPassthrough(): void
    {
        $ascii = 'Hello World 123 !@#';
        $this->assertSame($ascii, StripAccents::strip($ascii));
    }

    public function testEmptyString(): void
    {
        $this->assertSame('', StripAccents::strip(''));
    }

    public function testLigatures(): void
    {
        $this->assertSame('oe', StripAccents::strip('œ'));
        $this->assertSame('AE', StripAccents::strip('Æ'));
    }

    public function testStripNonPrint(): void
    {
        $this->assertSame('ABC AEY ', StripAccents::stripNonPrint("ABC ÀÈÝ 是我这"));
    }

    public function testStripNonPrintWithReplacement(): void
    {
        $result = StripAccents::stripNonPrint("ABC ÀÈÝ 是我这", '-');
        $this->assertStringStartsWith('ABC AEY ', $result);
        // each CJK character is 3 bytes in UTF-8, each non-printable byte is replaced individually
        $this->assertSame(9, substr_count($result, '-'));
    }

    public function testStripNonPrintEmptyString(): void
    {
        $this->assertSame('', StripAccents::stripNonPrint(''));
    }
}
