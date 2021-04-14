<?php

namespace App\Models;

use App\Core\Model as Model;

class CartItem extends Model
{
	private $table = "cart_item";
	
	// object properties
	protected $id;
	protected $user_id;
	protected $product_id;
	protected $type_id;
	protected $quantity;
	protected $price;
}