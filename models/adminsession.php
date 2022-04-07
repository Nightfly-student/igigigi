<?php
class AdminSession
{
    private int $restaurant_id;
    private string $title;
    private string $date_time;
    private string $duration;
    private string $amount_available;
    private string $price;
    private string $openingtime;
    
    //getters
    public function getId(): int
    {
        return $this->restaurant_id;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getDatetime(): string
    {
        return $this->date_time;
    }
    public function getDuration(): string
    {
        return $this->duration;
    }
    public function getAmountAvailable(): string
    {
        return $this->amount_available;
    }
    public function getPrice(): string
    {
        return $this->price;
    }

    //setters
    public function setId($value)
    {
        $this->restaurant_id = $value;
    }
    public function setTitle($value)
    {
        $this->title = $value;
    }
    public function setDatetime($value)
    {
        $this->date_time = $value;
    }
    public function setDuration($value)
    {
        $this->duration = $value;
    }
    public function setAmountAvailable($value)
    {
        $this->amount_available = $value;
    }
    public function setPrice($value)
    {
        $this->price = $value;
    }
    public function setOpeningtime($value)
    {
        $this->openingtime = $value;
    }
    
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        return $vars;
    }
}
