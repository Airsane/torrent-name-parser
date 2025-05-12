<?php

declare(strict_types=1);

namespace Airsane\TorrentNameParser;

use Airsane\TorrentNameParser\Patterns\PatternInterface;

class TorrentNameParser
{
    /**
     * @var PatternInterface[]
     */
    private array $patterns = [];

    /**
     * Add a pattern to the parser
     */
    public function addPattern(PatternInterface $pattern): self
    {
        $this->patterns[] = $pattern;
        return $this;
    }

    /**
     * Parse a torrent name
     */
    public function parse(string $torrentName): ParsedTorrent
    {
        $parsedTorrent = new ParsedTorrent($torrentName);

        foreach ($this->patterns as $pattern) {
            $pattern->parse($torrentName, $parsedTorrent);
        }

        return $parsedTorrent;
    }

    /**
     * Create a new parser with default patterns
     */
    public static function createDefault(): self
    {
        $parser = new self();
        
        // Add default patterns
        $parser->addPattern(new Patterns\YearPattern())
               ->addPattern(new Patterns\QualityPattern())
               ->addPattern(new Patterns\SourcePattern())
               ->addPattern(new Patterns\EpisodePattern())
               ->addPattern(new Patterns\GroupPattern())
               ->addPattern(new Patterns\TitlePattern()); // Title should be last as it's a fallback
        
        return $parser;
    }
}