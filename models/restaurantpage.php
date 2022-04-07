<?php

class Restaurantpage implements \JsonSerializable  {
    private int $restaurant_id;
    private string $location;
    private string $title;
    private string $body;
    private string $img_link;
    private string $openingtime;
    private string $cuisine;
    private string $cuisine_flags;
    private string $accesibility;
    private int $event_session_id;
    private string $date_time;
    private string $category;
    private int $amount_available;

    public function getId(): int
    {
        return $this->restaurant_id;
    }

    public function getLocation(): string
    {
        return $this->location;
    }
    
    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->body;
    }
    
    public function getImage(): string
    {
        return $this->img_link;
    }

    public function getOpeningtime(): string
    {
        return $this->openingtime;
    }

    public function getCuisine(): string
    {
        return $this->cuisine;
    }

    public function getCuisineFlags(): string
    {
        return $this->cuisine_flags;
    }
    
    public function getAccesibility(): string
    {
        return $this->accesibility;
    }

    public function getEventSessionId(): string
    {
        return $this->event_session_id;
    }

    public function getDatetime(): string
    {
        return $this->date_time;
    }
    public function getCategory(): string
    {
        return $this->category;
    }
    public function getAmount(): int
    {
        return $this->amount_available;
        
    }
    #[\ReturnTypeWillChange]
    public function jsonSerialize()  {
        $vars = get_object_vars($this);
        return $vars;
    }
}
?>