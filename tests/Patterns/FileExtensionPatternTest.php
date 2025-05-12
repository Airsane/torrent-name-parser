<?php

declare(strict_types=1);

namespace Airsane\TorrentNameParser\Tests\Patterns;

use PHPUnit\Framework\TestCase;
use Airsane\TorrentNameParser\ParsedTorrent;
use Airsane\TorrentNameParser\Patterns\FileExtensionPattern;

class FileExtensionPatternTest extends TestCase
{
    private FileExtensionPattern $pattern;

    protected function setUp(): void
    {
        $this->pattern = new FileExtensionPattern();
    }

    /**
     * @dataProvider fileExtensionProvider
     */
    public function testParseFileExtension(string $torrentName, ?string $expectedExtension): void
    {
        $parsedTorrent = new ParsedTorrent($torrentName);
        $this->pattern->parse($torrentName, $parsedTorrent);
        
        $this->assertSame($expectedExtension, $parsedTorrent->getFileExtension());
    }

    public function fileExtensionProvider(): array
    {
        return [
            'MKV extension' => ['Movie.Title.2020.1080p.BluRay.x264.mkv', 'mkv'],
            'MP4 extension' => ['TV.Show.S01E01.720p.HDTV.mp4', 'mp4'],
            'AVI extension' => ['Movie.Title.1999.DVDRip.avi', 'avi'],
            'No extension' => ['Movie.Title.2020.1080p.BluRay.x264-GROUP', null],
            'Extension in middle' => ['Movie.Title.mp4.2020.1080p', null],
            'Uppercase extension' => ['Movie.Title.2020.1080p.BluRay.x264.MKV', 'mkv'],
            'Multiple dots' => ['Movie.Title.2020.1080p.BluRay.x264.PROPER.mkv', 'mkv'],
        ];
    }
}