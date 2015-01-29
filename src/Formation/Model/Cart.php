<?php

namespace Formation\Model;

use Formation\Util\DiscountCodeHelper;

class Cart
{
    public $cartItems = array();
    protected $discountCode;

    public static $discountCodes = array(
        'VOEUX15' => 15,
        'VOEUX20' => 20,
    );

    public function setDiscountCode($discountCode)
    {
        $discountCode = DiscountCodeHelper::normalize($discountCode);

        if (!isset(self::$discountCodes[$discountCode])) {
            throw new \LogicException(
                sprintf('Discount code "%s" does not exists', $discountCode)
            );
        }

        $this->discountCode = $discountCode;
        $discountRate = self::$discountCodes[$discountCode];

        foreach ($this->cartItems as $cartItem) {
            $cartItem->setDiscountRate($discountRate);
        }
    }

    public function addItem(CartItem $cartItem)
    {
        $this->cartItems[] = $cartItem;
    }

    public function deleteItem(CartItem $expected)
    {
        foreach($this->cartItems as $key => $cartItem) {
            if ($expected === $cartItem) {
                unset($this->cartItems[$key]);

                return;
            }
        }

        throw new \LogicException('Unable to delete cartItem');
    }

    public function getTotalItems()
    {
        return count($this->cartItems);
    }

    public function getTotalAmount()
    {
        $totalAmount = 0;

        foreach ($this->cartItems as $cartItem) {
            $totalAmount+= $cartItem->getAmount();
        }

        return $totalAmount;
    }

    public function getItems()
    {
        return $this->cartItems;
    }

    public function isOrderable()
    {
        foreach ($this->cartItems as $cartItem) {
            if (!$cartItem->isOrderable()) {
                return false;
            }
        }

        return true;
    }
}
