<?php

declare(strict_types=1);

namespace Airsane\TorrentNameParser\Patterns;

use Airsane\TorrentNameParser\ParsedTorrent;

class YearPattern implements PatternInterface
{
    public function parse(string $torrentName, ParsedTorrent $parsedTorrent): void
    {
        // Match year in format (YYYY) or .YYYY.
        if (preg_match('/[. \[(](?<year>19\d{2}|20\d{2})[. \])]/', $torrentName, $matches)) {
            $parsedTorrent->setYear((int) $matches['year']);
        }
    }
}