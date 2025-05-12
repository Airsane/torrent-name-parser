<?php

declare(strict_types=1);

namespace Airsane\TorrentNameParser\Tests\Patterns;

use PHPUnit\Framework\TestCase;
use Airsane\TorrentNameParser\ParsedTorrent;
use Airsane\TorrentNameParser\Patterns\YearPattern;

class YearPatternTest extends TestCase
{
    private YearPattern $pattern;

    protected function setUp(): void
    {
        $this->pattern = new YearPattern();
    }

    /**
     * @dataProvider yearProvider
     */
    public function testParseYear(string $torrentName, ?int $expectedYear): void
    {
        $parsedTorrent = new ParsedTorrent($torrentName);
        $this->pattern->parse($torrentName, $parsedTorrent);
        
        $this->assertSame($expectedYear, $parsedTorrent->getYear());
    }

    public function yearProvider(): array
    {
        return [
            'Year in brackets' => ['Movie (2020)', 2020],
            'Year with dots' => ['Movie.2020.Quality', 2020],
            'Year with spaces' => ['Movie 2020 Quality', 2020],
            'Year in square brackets' => ['Movie [2020] Quality', 2020],
            'No year' => ['Movie Quality', null],
            'Invalid year format' => ['Movie 20200 Quality', null],
            'Year from 1900s' => ['Movie 1999 Quality', 1999],
            'Year from 2000s' => ['Movie 2023 Quality', 2023],
        ];
    }
}