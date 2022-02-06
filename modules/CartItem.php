<?php


class CartItem
{
    private Product $product;
    private int $quantity;


    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }


    /**
     * @throws Exception
     */
    public function increaseQuantity($amount = 1)
    {
        if($this->getQuantity() + $amount > $this->getProduct()->getAvailableQuantity()){
            throw new Exception("Product cannot be more than ".$this->getProduct()->getAvailableQuantity());
        }
        $this->quantity += $amount;
    }

    /**
     * @throws Exception
     */
    public function decreaseQuantity($amount = 1)
    {
        if($this->getQuantity()- $amount < 1){
            throw new Exception("Quantity cannot be less than one");
        }
        $this->quantity += $amount;
    }
}