<?php

declare(strict_types=1);

namespace Airsane\TorrentNameParser;

class ParsedTorrent
{
    private string $originalName;
    private ?string $title = null;
    private ?int $year = null;
    private ?string $quality = null;
    private ?string $source = null;
    private ?string $codec = null;
    private ?string $group = null;
    private ?int $season = null;
    private ?int $episode = null;
    private ?string $language = null;
    private ?string $resolution = null;
    private ?string $audio = null;
    private array $excess = [];

    public function __construct(string $originalName)
    {
        $this->originalName = $originalName;
    }

    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setYear(?int $year): self
    {
        $this->year = $year;
        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setQuality(?string $quality): self
    {
        $this->quality = $quality;
        return $this;
    }

    public function getQuality(): ?string
    {
        return $this->quality;
    }

    public function setSource(?string $source): self
    {
        $this->source = $source;
        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setCodec(?string $codec): self
    {
        $this->codec = $codec;
        return $this;
    }

    public function getCodec(): ?string
    {
        return $this->codec;
    }

    public function setGroup(?string $group): self
    {
        $this->group = $group;
        return $this;
    }

    public function getGroup(): ?string
    {
        return $this->group;
    }

    public function setSeason(?int $season): self
    {
        $this->season = $season;
        return $this;
    }

    public function getSeason(): ?int
    {
        return $this->season;
    }

    public function setEpisode(?int $episode): self
    {
        $this->episode = $episode;
        return $this;
    }

    public function getEpisode(): ?int
    {
        return $this->episode;
    }

    public function setLanguage(?string $language): self
    {
        $this->language = $language;
        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setResolution(?string $resolution): self
    {
        $this->resolution = $resolution;
        return $this;
    }

    public function getResolution(): ?string
    {
        return $this->resolution;
    }

    public function setAudio(?string $audio): self
    {
        $this->audio = $audio;
        return $this;
    }

    public function getAudio(): ?string
    {
        return $this->audio;
    }

    public function addExcess(string $excess): self
    {
        $this->excess[] = $excess;
        return $this;
    }

    public function getExcess(): array
    {
        return $this->excess;
    }

    /**
     * Convert to array
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'year' => $this->year,
            'quality' => $this->quality,
            'source' => $this->source,
            'codec' => $this->codec,
            'group' => $this->group,
            'season' => $this->season,
            'episode' => $this->episode,
            'language' => $this->language,
            'resolution' => $this->resolution,
            'audio' => $this->audio,
            'excess' => $this->excess,
        ];
    }

    /**
     * Convert to JSON
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}