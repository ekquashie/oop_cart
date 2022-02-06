<?php


class Cart
{
    /**
     * @var CartItem[]
     */
    private array $items = [];

    /**
     * @return CartItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param CartItem[] $items
     */
    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    /**
     * Add Product $product into cart. If product already exists inside cart
     * it must update quantity.
     * This must create CartItem and return CartItem from method
     * Bonus: $quantity must not become more than whatever
     * is $availableQuantity of the Product
     *
     * @param Product $product
     * @param int $quantity
     * @return void
     * @throws Exception
     */
    public function addProduct(Product $product, int $quantity): CartItem
    {
        //find existing product
        $cartItem = $this->findCartItem($product->getId());
        if($cartItem === null) {
            $cartItem = new CartItem($product, 0);
            $this->items[] = $cartItem;
        }

         $cartItem->increaseQuantity($quantity);
         return $cartItem;
    }

    private function findCartItem(int $productId): ?Product
    {
        foreach ($this->items as $item) {
            if($item->getProduct()->getId() === $productId) {
                return $item->getProduct();
            }
        }
        return null;
    }

    /**
     * Remove product from cart
     *
     * @param Product $product
     */
    public function removeProduct(Product $product)
    {
        foreach($this->items as $index => $item) {
            if($item->getProduct()->getId() === $product->getId()) {
                unset($this->items[$index]);
                break;
            }
        }
    }

    /**
     * This returns total number of products added in cart
     *
     * @return int
     */
    public function getTotalQuantity(): int
    {
        $sum = 0;
        foreach ($this->items as $item) {
            $sum += $item->getQuantity();
        }
        return $sum;
    }

    /**
     * This returns total price of products added in cart
     *
     * @return float
     */
    public function getTotalSum(): float
    {
        $totalSum = 0;
        foreach($this->items as $item) {
            $totalSum += $item->getQuantity() * $item->getProduct()->getPrice();
        }
        return $totalSum;
    }
}