<?php

declare(strict_types=1);

namespace Airsane\TorrentNameParser\Tests\Patterns;

use PHPUnit\Framework\TestCase;
use Airsane\TorrentNameParser\ParsedTorrent;
use Airsane\TorrentNameParser\Patterns\QualityPattern;

class QualityPatternTest extends TestCase
{
    private QualityPattern $pattern;

    protected function setUp(): void
    {
        $this->pattern = new QualityPattern();
    }

    /**
     * @dataProvider qualityProvider
     */
    public function testParseQuality(string $torrentName, ?string $expectedQuality, ?string $expectedResolution): void
    {
        $parsedTorrent = new ParsedTorrent($torrentName);
        $this->pattern->parse($torrentName, $parsedTorrent);
        
        $this->assertSame($expectedQuality, $parsedTorrent->getQuality());
        $this->assertSame($expectedResolution, $parsedTorrent->getResolution());
    }

    public function qualityProvider(): array
    {
        return [
            'Quality 1080p' => ['Movie.2020.1080p.BluRay', '1080p', '1080p'],
            'Quality 720p' => ['Movie.2020.720p.WEB-DL', '720p', '720p'],
            'Quality 2160p' => ['Movie.2020.2160p.HDR', '2160p', '2160p'],
            'Quality 4K' => ['Movie.2020.4K.HDR', '4K', null],
            'Quality UHD' => ['Movie.2020.UHD.HDR', 'UHD', null],
            'No quality' => ['Movie.2020.HDR', null, null],
            'Multiple same quality' => ['Movie.2020.1080p.BluRay.1080p', '1080p', '1080p'],
            'Different qualities' => ['Movie.2020.1080p.720p.BluRay', '1080p', '1080p'],
        ];
    }
}