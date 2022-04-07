<?php

class Location implements \JsonSerializable  {
    private int $location_id;
    private string $historic_event_id;
    private string $location_title;
    private string $location_content;
    private string $gps_location;

    public function getId(): int
    {
        return $this->location_id;
    }

    public function getEventId(): int
    {
        return $this->historic_event_id;
    }

    public function getTitle(): string
    {
        return $this->location_title;
    }

    public function getContent(): string
    {
        return $this->location_content;
    }

    public function getGps(): string
    {
        return $this->gps_location;
    }
    #[\ReturnTypeWillChange]
    public function jsonSerialize()  {
        $vars = get_object_vars($this);
        return $vars;
    }
}
?>