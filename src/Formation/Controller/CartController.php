<?php

namespace Formation\Controller;

use Formation\Model\Cart;
use Formation\Model\CartItem;
use Framework\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CartController extends Controller
{
    public function addAction(Request $request)
    {
        $name = $request->request->get('name');
        $article = $this->container->get('article_xmascard_repository')->find($name);
        if ($article === null) {
            throw new NotFoundHttpException(sprintf('Article with name "%s" does not exists', $name));
        }

        $quantity = $request->request->get('quantity');
        if (!ctype_digit($quantity)) {
            throw new \Exception('Quantity should be an integer');
        }

        $session = $this->container->get('session');

        if (!$session->has('cart')) {
            $session->set('cart', new Cart());
        }

        $cart = $session->get('cart');
        $cartItem = new CartItem($article, $quantity);
        $cart->addItem($cartItem);

        return new RedirectResponse('/cart');
    }

    public function showAction(Request $request)
    {
        $session = $this->container->get('session');
        $cart = $session->get('cart', new Cart());

        return $this->render('Cart/show.html.twig', array(
            'cart' => $cart,
        )); 
    }

    public function editAction(Request $request, $id)
    {
        $session = $this->container->get('session');
        $cart = $session->get('cart', new Cart());
        $cartItems = $cart->getItems();

        if (!isset($cartItems[$id]) || empty($cartItems[$id])) {
            throw new NotFoundHttpException('Cart item not found');
        }

        $cartItem = $cartItems[$id];

        switch ($cartItem->getState()) {
            case CartItem::BLANK:
                $cartItem->setState(CartItem::CUSTOMIZED);
                break;
            
            default:
                $cartItem->setState(CartItem::BLANK);
                break;
        }

        return new RedirectResponse('/cart');
    }
}
