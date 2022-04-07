<?php

class Ticket implements \JsonSerializable  {
    private int $ticket_id;
    private int $event_session_id;
    private int $order_id;
    private float $ticket_price;
    private bool $is_used;
    private string $expireDate;
    private string $identifier;


    public function getId(): int
    {
        return $this->ticket_id;
    }

    public function getSession(): int
    {
        return $this->event_session_id;
    }

    public function getOrder(): int
    {
        return $this->order_id;
    }

    public function getPrice(): float
    {
        return $this->ticket_price;
    }

    public function getUsed(): bool
    {
        return $this->is_used;
    }

    public function getExpire(): string
    {
        return $this->expireDate;
    }
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize()  {
        $vars = get_object_vars($this);
        return $vars;
    }
}
?>