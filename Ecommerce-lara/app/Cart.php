0<?php

namespace App;

class Cart
{
    private $items = null;
    private $totalQty = 0;
    private $totalPrice = 0;


    public function __construct($oldCart){
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }

    }

    public function add($item, $id){

        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];

        if($this->items){
            if (array_key_exists($id, $this->items)){
               $storedItem = $this->items[$id];
            }
        }
        
        $storedItem['qty']++;
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->price;
    }

    //Update Cart

    public function updateCart($product, $qty){
        if($this->items){
            if(array_key_exists($product->id, $this->items)){
                $storedItem = $this->items[$product->id];
            }
        }

        $this->totalPrice -= $storedItem['price'];
        $this->totalQty -= $storedItem['qty'];
        $storedItem['qty'] = $qty;
        $storedItem['price'] = $product->price * $qty;
        $this->totalPrice += $storedItem['price'];
        $this->totalQty += $qty;
        $this->items[$product->id] = $storedItem;
    }

    //Remove item from cart

    public function removeItem($product){
        if($this->items){
            if(array_key_exists($product->id, $this->items)){
                $rProduct = $this->items[$product->id];
                $this->totalPrice -= $rProduct['price'];
                $this->totalQty -= $rProduct['qty'];
                unset($this->items[$product->id]);
            }
        }
    }

    
    // public function addProduct($product, $qty){
    // 	$products = ['qty' => 0, 'price' => $product->price, 'product' => $product];

    // 	if($this->contents){
    //         //dd($this->contents);
    // 		if(array_key_exists($product->slug, $this->contents)){
    // 			$products = $this->contents[$product->slug];
    // 		}
    // 	}

    // 	$products['qty'] += $qty;
    // 	$products['price'] = $product->price * $products['qty'];
    // 	$this->contents[$product->slug] = $products;
    //     //dd($this->contents[$product->slug]['product']['slug']);
    // 	$this->totalPrice += $product->price;
    // 	$this->totalQty += $qty; 
    // }

    // public function removeProduct($product){
    //     if($this->contents){
    //         if(array_key_exists($product->slug, $this->contents)){
    //             $rProduct = $this->contents[$product->slug];
    //             //dd($rProduct);
    //             $this->totalQty -= $rProduct['qty'];
    //             $this->totalPrice -= $rProduct['price'];
    //             //array_foget($this->contents, $product->slug);
    //             unset($this->contents[$product->slug]);
    //         }
    //     }
    // }

    // public function updateProduct($product, $qty){

    //     if($this->contents){
    //         if(array_key_exists($product->slug, $this->contents)){
    //             $products = $this->contents[$product->slug];
    //         }
    //     }
        
    //     $this->totalQty -= $products['qty'];
    //     $this->totalPrice -= $products['price'];  
    //     $products['qty'] = $qty;
    //     $products['price'] = $product->price * $qty;
    //     $this->totalPrice += $products['price'];
    //     $this->totalQty += $qty; 
    //     $this->contents[$product->slug] = $products;
    // }

    public function getContents(){
        return $this->items;
    }

    public function getTotalPrice(){
        return $this->totalPrice;
    }

    public function getTotalQty(){
        return $this->totalQty;
    }

  

}








