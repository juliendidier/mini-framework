<?php

namespace Formation\Tests\Model;

use Formation\Model;

class CartTest extends \PHPUnit_Framework_TestCase
{
    public function testDeleteItem()
    {
        $xmasCard = new Model\XmasCard();

        $cart = new Model\Cart();
        $cartItem = new Model\CartItem($xmasCard, 100);
        $cart->addItem($cartItem);

        $this->assertCount(1, $cart->getItems());
        $this->assertEquals(1, $cart->getTotalItems());

        $cart->deleteItem($cartItem);

        $this->assertCount(0, $cart->getItems());
        $this->assertEquals(0, $cart->getTotalItems());
    }

    public function testTotalAmountItem()
    {
        $xmasCard = new Model\XmasCard();
        $xmasCard->setPrice(0.99);

        $cart = new Model\Cart();
        $cartItem = new Model\CartItem($xmasCard, 100);
        $cart->addItem($cartItem);

        $this->assertEquals(99, $cart->getTotalAmount());

        $xmasCard->isVarnished = true;
        $this->assertEquals((99+Model\Article::VARNISH_COST), $cart->getTotalAmount());

        $cart->setDiscountCode('vŒUx20');
        $expectedPrice = round(0.99 * 0.8, 2) * 100;
        $this->assertEquals(($expectedPrice+Model\Article::VARNISH_COST), $cart->getTotalAmount());        
    }

    public function testIsOrderable()
    {
        $xmasCard = new Model\XmasCard();
        $cart = new Model\Cart();
        $cartItem = new Model\CartItem($xmasCard, 100);
        $cart->addItem($cartItem);

        $this->assertTrue($cart->isOrderable());

        $cartItem->setState(Model\CartItem::BLANK);

        $this->assertFalse($cart->isOrderable());
    }
}
