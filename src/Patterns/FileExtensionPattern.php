<?php

declare(strict_types=1);

namespace Airsane\TorrentNameParser\Patterns;

use Airsane\TorrentNameParser\ParsedTorrent;

class FileExtensionPattern implements PatternInterface
{
    /**
     * Common video file extensions
     */
    private const FILE_EXTENSIONS = [
        'mkv', 'mp4', 'avi', 'mov', 'wmv', 'flv', 'm4v', 'webm', 'mpg', 'mpeg',
        'iso', 'ts', 'divx', 'xvid', 'rm', 'rmvb', 'ogm', 'vob', '3gp', 'asf'
    ];

    public function parse(string $torrentName, ParsedTorrent $parsedTorrent): void
    {
        $extension = null;
        
        // Create a pattern to match file extensions at the end of the string
        $pattern = '/\.(' . implode('|', self::FILE_EXTENSIONS) . ')$/i';
        
        if (preg_match($pattern, $torrentName, $matches)) {
            $extension = strtolower($matches[1]);
            $parsedTorrent->setFileExtension($extension);
        }
    }
}