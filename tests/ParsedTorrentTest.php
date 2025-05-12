<?php

declare(strict_types=1);

namespace Airsane\TorrentNameParser\Tests;

use PHPUnit\Framework\TestCase;
use Airsane\TorrentNameParser\ParsedTorrent;

class ParsedTorrentTest extends TestCase
{
    public function testGetOriginalName(): void
    {
        $originalName = 'The.Matrix.1999.1080p.BluRay.x264-GROUP';
        $parsedTorrent = new ParsedTorrent($originalName);
        
        $this->assertSame($originalName, $parsedTorrent->getOriginalName());
    }

    public function testSetAndGetTitle(): void
    {
        $parsedTorrent = new ParsedTorrent('test');
        $parsedTorrent->setTitle('The Matrix');
        
        $this->assertSame('The Matrix', $parsedTorrent->getTitle());
    }

    public function testToArray(): void
    {
        $parsedTorrent = new ParsedTorrent('test');
        $parsedTorrent->setTitle('The Matrix')
                      ->setYear(1999)
                      ->setQuality('1080p')
                      ->setSource('BluRay')
                      ->setCodec('x264')
                      ->setGroup('GROUP');
        
        $expected = [
            'title' => 'The Matrix',
            'year' => 1999,
            'quality' => '1080p',
            'source' => 'BluRay',
            'codec' => 'x264',
            'group' => 'GROUP',
            'season' => null,
            'episode' => null,
            'language' => null,
            'resolution' => null,
            'audio' => null,
            'fileExtension' => null,
            'excess' => [],
        ];
        
        $this->assertSame($expected, $parsedTorrent->toArray());
    }

    public function testToJson(): void
    {
        $parsedTorrent = new ParsedTorrent('test');
        $parsedTorrent->setTitle('The Matrix')
                      ->setYear(1999);
        
        $expected = json_encode([
            'title' => 'The Matrix',
            'year' => 1999,
            'quality' => null,
            'source' => null,
            'codec' => null,
            'group' => null,
            'season' => null,
            'episode' => null,
            'language' => null,
            'resolution' => null,
            'audio' => null,
            'fileExtension' => null,
            'excess' => [],
        ]);
        
        $this->assertSame($expected, $parsedTorrent->toJson());
    }
}