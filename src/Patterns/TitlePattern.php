<?php

declare(strict_types=1);

namespace Airsane\TorrentNameParser\Patterns;

use Airsane\TorrentNameParser\ParsedTorrent;

class TitlePattern implements PatternInterface
{
    public function parse(string $torrentName, ParsedTorrent $parsedTorrent): void
    {
        // This should be run last after other patterns have extracted their data
        $title = $torrentName;
        
        // Remove year if found
        if ($parsedTorrent->getYear() !== null) {
            $title = preg_replace('/[. \[(]' . $parsedTorrent->getYear() . '[. \])]/', ' ', $title);
        }
        
        // Remove quality
        if ($parsedTorrent->getQuality() !== null) {
            $title = preg_replace('/\b' . preg_quote($parsedTorrent->getQuality(), '/') . '\b/i', ' ', $title);
        }
        
        // Remove source
        if ($parsedTorrent->getSource() !== null) {
            $title = preg_replace('/\b' . preg_quote($parsedTorrent->getSource(), '/') . '\b/i', ' ', $title);
        }
        
        // Remove codec
        if ($parsedTorrent->getCodec() !== null) {
            $title = preg_replace('/\b' . preg_quote($parsedTorrent->getCodec(), '/') . '\b/i', ' ', $title);
        }
        
        // Remove group
        if ($parsedTorrent->getGroup() !== null) {
            $title = preg_replace('/-' . preg_quote($parsedTorrent->getGroup(), '/') . '$/', '', $title);
        }
        
        // Remove episode info
        if ($parsedTorrent->getSeason() !== null && $parsedTorrent->getEpisode() !== null) {
            $title = preg_replace('/S\d{1,2}E\d{1,2}/i', ' ', $title);
            $title = preg_replace('/\d{1,2}x\d{1,2}/i', ' ', $title);
            $title = preg_replace('/season\s+\d{1,2}\s+episode\s+\d{1,2}/i', ' ', $title);
        }
        
        // Remove resolution
        if ($parsedTorrent->getResolution() !== null) {
            $title = preg_replace('/\b' . preg_quote($parsedTorrent->getResolution(), '/') . '\b/i', ' ', $title);
        }
        
        // Remove audio
        if ($parsedTorrent->getAudio() !== null) {
            $title = preg_replace('/\b' . preg_quote($parsedTorrent->getAudio(), '/') . '\b/i', ' ', $title);
        }
        
        // Remove file extension
        if ($parsedTorrent->getFileExtension() !== null) {
            $title = preg_replace('/\.' . preg_quote($parsedTorrent->getFileExtension(), '/') . '$/i', '', $title);
        }
        
        // Remove common quality terms that might not be captured by quality pattern
        $commonTerms = ['UHD', 'HD', 'SD', '4K', 'Atmos'];
        foreach ($commonTerms as $term) {
            $title = preg_replace('/\b' . preg_quote($term, '/') . '\b/i', ' ', $title);
        }
        
        // Clean up the title
        $title = preg_replace('/\s+/', ' ', $title); // Replace multiple spaces with a single space
        $title = preg_replace('/\s*[\._-]\s*/', ' ', $title); // Replace dots, underscores, and hyphens with spaces
        $title = trim($title);
        
        $parsedTorrent->setTitle($title);
    }
}