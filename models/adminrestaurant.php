<?php
class AdminRestaurant
{
    private int $restaurant_id;
    private string $location;
    private string $title;
    private string $body;
    private string $img_link;
    private string $openingtime;
    private string $cuisine;
    private string $accessibility;

    //getters
    public function getId(): int
    {
        return $this->restaurant_id;
    }
    public function getLocation(): string
    {
        return $this->location;
    }
    public function getBody(): string
    {
        return $this->body;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getImgLink(): string
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
    public function getAccessibility(): string
    {
        return $this->accessibility;
    }

    //setters
    public function setId($value)
    {
        $this->restaurant_id = $value;
    }
    public function setLocation($value)
    {
        $this->location = $value;
    }
    public function setBody($value)
    {
        $this->body = $value;
    }
    public function setTitle($value)
    {
        $this->title = $value;
    }
    public function setImgLink($value)
    {
        $this->img_link = $value;
    }
    public function setOpeningtime($value)
    {
        $this->openingtime = $value;
    }
    public function setCuisine($value)
    {
        $this->cuisine = $value;
    }
    public function setAccessibility($value)
    {
        $this->accessibility = $value;
    }

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        return $vars;
    }
}
