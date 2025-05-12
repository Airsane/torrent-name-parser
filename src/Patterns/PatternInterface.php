<?php

declare(strict_types=1);

namespace Airsane\TorrentNameParser\Patterns;

use Airsane\TorrentNameParser\ParsedTorrent;

interface PatternInterface
{
    /**
     * Parse a torrent name and update the ParsedTorrent object
     */
    public function parse(string $torrentName, ParsedTorrent $parsedTorrent): void;
}