<?php

declare(strict_types=1);

namespace Airsane\TorrentNameParser\Patterns;

use Airsane\TorrentNameParser\ParsedTorrent;

class SourcePattern implements PatternInterface
{
    private const SOURCES = [
        'BluRay', 'Blu-Ray', 'BDREMUX', 'BDRip', 'BRRip', 'DVDR', 'DVD', 'DVDRip',
        'HDTV', 'PDTV', 'WebRip', 'WebDL', 'WEB-DL', 'WEB', 'HDRip', 'HDRIP',
        'WEBRIP', 'WEBDL', 'AMZN', 'DSNP', 'HULU', 'HMAX', 'NFLX', 'ATVP'
    ];

    private const CODECS = [
        'x264', 'x265', 'h264', 'h265', 'h.264', 'h.265', 'HEVC', 'XVID', 'DIVX', 'AVC'
    ];

    private const AUDIO = [
        'AAC', 'AC3', 'DTS', 'DTS-HD', 'DTS-HDMA', 'TrueHD', 'Atmos', 'DD5.1', 'DD+', 'FLAC'
    ];

    public function parse(string $torrentName, ParsedTorrent $parsedTorrent): void
    {
        // Match source
        foreach (self::SOURCES as $source) {
            if (preg_match('/\b' . preg_quote($source, '/') . '\b/i', $torrentName)) {
                $parsedTorrent->setSource($source);
                break;
            }
        }

        // Match codec
        foreach (self::CODECS as $codec) {
            if (preg_match('/\b' . preg_quote($codec, '/') . '\b/i', $torrentName)) {
                $parsedTorrent->setCodec($codec);
                break;
            }
        }

        // Match audio
        foreach (self::AUDIO as $audio) {
            if (preg_match('/\b' . preg_quote($audio, '/') . '\b/i', $torrentName)) {
                $parsedTorrent->setAudio($audio);
                break;
            }
        }
    }
}