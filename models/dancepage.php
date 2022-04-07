<?php

class Dancepage implements \JsonSerializable  {
    private int $page_item_id;
    private string $page_item_title;
    private string $page_item_content;
    private int $page_item_category;
    private string $page_title;
    private string $page_image;

    public function getId(): int
    {
        return $this->page_item_id;
    }

    public function getItemTitle(): string
    {
        return $this->page_item_title;
    }

    public function getItemContent(): string
    {
        return $this->page_item_content;
    }

    public function getItemCategory(): int
    {
        return $this->page_item_category;
    }
    public function getDancePageTitle(): string
    {
        return $this->page_title;
    }
    public function getDancePageImage(): string
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