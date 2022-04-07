<?php

class Event implements \JsonSerializable  {
    private int $event_session_id;
    private string $duration;
    private string $date_time;
    private int $amount_available;
    private float $price;
    private string $title;
    private string $body;
    private string $extra;
    private string $category;
    private string $location;


    public function getId(): int
    {
        return $this->event_session_id;
    }

    public function getExtra(): string
    {
        return $this->extra;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->body;
    }

    public function getDuration(): string
    {
        return $this->duration;
    }

    public function getDate(): string
    {
        return $this->date_time;
    }

    public function getAmount(): int
    {
        return $this->amount_available;
    }

    public function getImg(): string
    {
        return $this->img_link;
    }
    public function getLocation(): string
    {
        return $this->location;
    }


    public function getPrice(): float
    {
        return $this->price;
    }
    public function getCategory(): string
    {
        return $this->category;
    }
    #[\ReturnTypeWillChange]
    public function jsonSerialize()  {
        $vars = get_object_vars($this);
        return $vars;
    }
}
?>