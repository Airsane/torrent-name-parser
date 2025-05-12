<?php

declare(strict_types=1);

namespace Airsane\TorrentNameParser\Patterns;

use Airsane\TorrentNameParser\ParsedTorrent;

class EpisodePattern implements PatternInterface
{
    public function parse(string $torrentName, ParsedTorrent $parsedTorrent): void
    {
        // Match S01E01 format
        if (preg_match('/S(?<season>\d{1,2})E(?<episode>\d{1,2})/i', $torrentName, $matches)) {
            $parsedTorrent->setSeason((int) $matches['season']);
            $parsedTorrent->setEpisode((int) $matches['episode']);
            return;
        }

        // Match season 1 episode 1 format
        if (preg_match('/season\s+(?<season>\d{1,2})\s+episode\s+(?<episode>\d{1,2})/i', $torrentName, $matches)) {
            $parsedTorrent->setSeason((int) $matches['season']);
            $parsedTorrent->setEpisode((int) $matches['episode']);
            return;
        }

        // Match 1x01 format
        if (preg_match('/(?<season>\d{1,2})x(?<episode>\d{1,2})/i', $torrentName, $matches)) {
            $parsedTorrent->setSeason((int) $matches['season']);
            $parsedTorrent->setEpisode((int) $matches['episode']);
            return;
        }
    }
}