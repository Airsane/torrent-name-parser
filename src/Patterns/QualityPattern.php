<?php

declare(strict_types=1);

namespace Airsane\TorrentNameParser\Patterns;

use Airsane\TorrentNameParser\ParsedTorrent;

class QualityPattern implements PatternInterface
{
    private const QUALITIES = [
        '2160p', '1080p', '720p', '480p', '360p',
        'UHD', '4K', 'HD', 'SD'
    ];

    private const RESOLUTIONS = [
        '2160p' => '4K',
        '1080p' => 'Full HD',
        '720p' => 'HD',
        '480p' => 'SD',
        '360p' => 'SD'
    ];

    public function parse(string $torrentName, ParsedTorrent $parsedTorrent): void
    {
        foreach (self::QUALITIES as $quality) {
            if (preg_match('/\b' . preg_quote($quality, '/') . '\b/i', $torrentName)) {
                $parsedTorrent->setQuality($quality);
                
                // Set resolution if it's a resolution-based quality
                if (isset(self::RESOLUTIONS[$quality])) {
                    $parsedTorrent->setResolution($quality);
                }
                
                break;
            }
        }
    }
}