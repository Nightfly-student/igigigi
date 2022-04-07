<?php

class DanceProgramme implements \JsonSerializable  {
    private string $venue_name;
    private string $title;
    private string $dance_session;
    private string $date_time;
    private float $price;
    private int $amount_available;
    private string $duration;
    private int $dance_event_id;
    private int $event_session_id;
    private string $body;
    private int $venue_id;
    private string $location;

    public function getTitle(): string
    {
        return $this->title;
    }
    public function getSession(): string
    {
        return $this->dance_session;
    }
    public function getDateTime(): string
    {
        return $this->date_time;
    }
    public function getPrice(): float
    {
        return $this->price;
    }
    public function getTickets(): int
    {
        return $this->amount_available;
    }
    public function getDuration(): string
    {
        return $this->duration;
    }
    public function getVenueName(): string  
    {
        return $this->venue_name;
    }
    public function getDanceEventId(): int  
    {
        return $this->dance_event_id;
    }
    public function getEventSessionId(): int
    {
        return $this->event_session_id;
    }
    public function getBody() : string  
    {
        return $this->body;
    }
    public function getVenueId(): int 
    {
        return $this->venue_id;
    }
    public function getLocation(): string  
    {
        return $this->location;
    }

    public function setTitle($value)
    {
        $this->title = $value;
    }
    public function setSession($value)
    {
        $this->dance_session = $value;
    }
    public function setDateTime($value)
    {
        $this->date_time = $value;
    }
    public function setPrice($value)
    {
        $this->price = $value;
    }
    public function setTicketsAvailable($value)
    {
        $this->amount_available = $value;
    }
    public function setDuration($value)
    {
        $this->duration = $value;
    }
    public function setVenueId($value)
    {
        $this->venue_id = $value;
    }
    public function setDescription($value)
    {
        $this->body = $value;
    }
    public function setLocation($value)
    {
        $this->location = $value;
    }
    public function setDanceSessionId($value)
    {
        $this->event_session_id = $value;
    }
    public function setDanceEventId($value)
    {
        $this->dance_event_id = $value;
    }
    #[\ReturnTypeWillChange]
    public function jsonSerialize()  {
        $vars = get_object_vars($this);
        return $vars;
    }
}
?>