<?php

class Club implements \JsonSerializable  {
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
    #[\ReturnTypeWillChange]
    public function jsonSerialize()  {
        $vars = get_object_vars($this);
        return $vars;
    }
}
?>