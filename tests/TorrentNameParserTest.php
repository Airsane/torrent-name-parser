<?php

declare(strict_types=1);

namespace Airsane\TorrentNameParser\Tests;

use PHPUnit\Framework\TestCase;
use Airsane\TorrentNameParser\TorrentNameParser;

class TorrentNameParserTest extends TestCase
{
    private TorrentNameParser $parser;

    protected function setUp(): void
    {
        $this->parser = TorrentNameParser::createDefault();
    }

    /**
     * @dataProvider torrentNameProvider
     */
    public function testParseTorrentName(string $torrentName, array $expected): void
    {
        $parsed = $this->parser->parse($torrentName);
        $actual = $parsed->toArray();

        foreach ($expected as $key => $value) {
            $this->assertSame($value, $actual[$key], "Failed asserting that {$key} matches expected value");
        }
    }

    public function torrentNameProvider(): array
    {
        return [
            'Movie with year, quality, source, codec and group' => [
                'The.Matrix.1999.1080p.BluRay.x264-GROUP',
                [
                    'title' => 'The Matrix',
                    'year' => 1999,
                    'quality' => '1080p',
                    'source' => 'BluRay',
                    'codec' => 'x264',
                    'group' => 'GROUP',
                ],
            ],
            'TV show with season and episode' => [
                'Breaking.Bad.S01E01.720p.HDTV.x264-GROUP',
                [
                    'title' => 'Breaking Bad',
                    'quality' => '720p',
                    'source' => 'HDTV',
                    'codec' => 'x264',
                    'group' => 'GROUP',
                    'season' => 1,
                    'episode' => 1,
                ],
            ],
            'TV show with alternative season and episode format' => [
                'Game of Thrones 1x01 HDTV x264-GROUP',
                [
                    'title' => 'Game of Thrones',
                    'source' => 'HDTV',
                    'codec' => 'x264',
                    'group' => 'GROUP',
                    'season' => 1,
                    'episode' => 1,
                ],
            ],
            'Movie with file extension' => [
                'The.Matrix.1999.1080p.BluRay.x264.mkv',
                [
                    'title' => 'The Matrix',
                    'year' => 1999,
                    'quality' => '1080p',
                    'source' => 'BluRay',
                    'codec' => 'x264',
                    'fileExtension' => 'mkv',
                ],
            ],
            'TV show with file extension' => [
                'Breaking.Bad.S01E01.720p.HDTV.x264.mp4',
                [
                    'title' => 'Breaking Bad',
                    'quality' => '720p',
                    'source' => 'HDTV',
                    'codec' => 'x264',
                    'season' => 1,
                    'episode' => 1,
                    'fileExtension' => 'mp4',
                ],
            ],
            'Movie with duplicate quality values' => [
                'The.Matrix.1999.1080p.BluRay.1080p.x264-GROUP',
                [
                    'title' => 'The Matrix',
                    'year' => 1999,
                    'quality' => '1080p',
                    'source' => 'BluRay',
                    'codec' => 'x264',
                    'group' => 'GROUP',
                ],
            ],
            'Movie with resolution and audio' => [
                'Inception.2010.2160p.UHD.BluRay.x265.TrueHD.Atmos-RELEASE',
                [
                    'title' => 'Inception',
                    'year' => 2010,
                    'quality' => '2160p',
                    'resolution' => '2160p',
                    'source' => 'BluRay',
                    'codec' => 'x265',
                    'audio' => 'TrueHD',
                    'group' => 'RELEASE',
                ],
            ],
        ];
    }

    public function testGetTitle(): void
    {
        $parsed = $this->parser->parse('The.Matrix.1999.1080p.BluRay.x264-GROUP');
        $this->assertSame('The Matrix', $parsed->getTitle());
    }

    public function testGetYear(): void
    {
        $parsed = $this->parser->parse('The.Matrix.1999.1080p.BluRay.x264-GROUP');
        $this->assertSame(1999, $parsed->getYear());
    }

    public function testGetQuality(): void
    {
        $parsed = $this->parser->parse('The.Matrix.1999.1080p.BluRay.x264-GROUP');
        $this->assertSame('1080p', $parsed->getQuality());
    }

    public function testGetSource(): void
    {
        $parsed = $this->parser->parse('The.Matrix.1999.1080p.BluRay.x264-GROUP');
        $this->assertSame('BluRay', $parsed->getSource());
    }

    public function testGetCodec(): void
    {
        $parsed = $this->parser->parse('The.Matrix.1999.1080p.BluRay.x264-GROUP');
        $this->assertSame('x264', $parsed->getCodec());
    }

    public function testGetGroup(): void
    {
        $parsed = $this->parser->parse('The.Matrix.1999.1080p.BluRay.x264-GROUP');
        $this->assertSame('GROUP', $parsed->getGroup());
    }

    public function testGetFileExtension(): void
    {
        $parsed = $this->parser->parse('The.Matrix.1999.1080p.BluRay.x264.mkv');
        $this->assertSame('mkv', $parsed->getFileExtension());
    }
}