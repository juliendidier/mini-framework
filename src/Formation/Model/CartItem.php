<?php

namespace Formation\Model;

class CartItem
{
    protected $article;
    protected $discountRate;
    protected $quantity;
    protected $state = self::BLANK;

    const BLANK = 0;
    const TO_CUSTOMIZE = 1;
    const CUSTOMIZED = 2;

    public function __construct(Article $article, $quantity)
    {
        $this->article = $article;
        $this->quantity = $quantity;
    }
    
    public function setState($state)
    {
        $this->state = $state;
    }

    public function getDiscountRate()
    {
        return $this->discountRate;
    }

    public function setDiscountRate($discountRate)
    {
        $this->discountRate = $discountRate;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getAmount()
    {
        $price = $this->article->getPrice();

        if (!empty($this->discountRate)) {
            $price = $price * (100 - $this->discountRate) / 100;
            $price = round($price, 2);
        }

        $amount = $this->quantity * $price;

        if ($this->article->isVarnished()) {
            $amount += Article::VARNISH_COST;
        }

        return $amount;
    }

    public function isOrderable()
    {
        return $this->state !== self::TO_CUSTOMIZE;
    }

    public function getArticle()
    {
        return $this->article;
    }
}
