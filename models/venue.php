<?php

class Venue {
    private int $venue_id;
    private string $venue_name;
    private string $venue_description;
    private string $venue_address;

    public function getId(): int
    {
        return $this->venue_id;
    }

    public function getName(): string
    {
        return $this->venue_name;
    }

    public function getDescription(): string
    {
        return $this->venue_description;
    }

    public function getAddress(): string
    {
        return $this->venue_address;
    }

    public function setId($id)
    {
        $this->venue_id = $id;
    }

    public function setName($name)
    {
        $this->venue_name = $name;
    }

    public function setDescription($description)
    {
        $this->venue_description = $description;
    }

    public function setAddress($address)
    {
        $this->venue_address = $address;
    }
    #[\ReturnTypeWillChange]
    public function jsonSerialize()  {
        $vars = get_object_vars($this);
        return $vars;
    }
}
