<?php

class Restaurant implements \JsonSerializable  {
    private int $restaurant_id;
    private string $location;
    private string $title;
    private string $body;
    private string $img_link;
    private string $openingtime;
    private string $cuisine;
    private string $cuisine_flags;
    private string $accesibility;
    private string $page_title;
    private string $page_header;
    private string $page_image;


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
   
    public function getPageTitle(): string
    {
        return $this->page_title;
    }

    public function getPageContent(): string
    {
        return $this->page_header;
    }

    public function getPageImage(): string
    {
        return $this->page_image;
    }
    
    #[\ReturnTypeWillChange]
    public function jsonSerialize()  {
        $vars = get_object_vars($this);
        return $vars;
    }
}
?>