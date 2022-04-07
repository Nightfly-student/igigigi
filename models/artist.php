<?php

class Artist implements \JsonSerializable  {
    private int $artist_id;
    private string $artist_name;
    private string $artist_information;
    private string $genre;
    private string $artist_image;

    public function getId(): int
    {
        return $this->artist_id;
    }

    public function getName(): string
    {
        return $this->artist_name;
    }

    public function getInformation(): string
    {
        return $this->artist_information;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function getImage(): string
    {
        return $this->artist_image;
    }

    public function setId($value)
    {
        $this->artist_id = $value;
    }

    public function setName($value)
    {
        $this->artist_name = $value;
    }

    public function setInformation($value)
    {
        $this->artist_information = $value;
    }

    public function setGenre($value)
    {
        $this->genre = $value;
    }

    public function setImage($value)
    {
        $this->artist_image = $value;
    }
    
    #[\ReturnTypeWillChange]
    public function jsonSerialize()  {
        $vars = get_object_vars($this);
        return $vars;
    }
}
