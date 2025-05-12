<?php

declare(strict_types=1);

namespace Airsane\TorrentNameParser\Patterns;

use Airsane\TorrentNameParser\ParsedTorrent;

class GroupPattern implements PatternInterface
{
    public function parse(string $torrentName, ParsedTorrent $parsedTorrent): void
    {
        // Match group name at the end of the torrent name
        if (preg_match('/-([A-Za-z0-9_]+)$/', $torrentName, $matches)) {
            $parsedTorrent->setGroup($matches[1]);
        }
    }
}