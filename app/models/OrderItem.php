<?php

namespace App\Models;

use App\Core\Model as Model;

class OrderItem extends Model
{
	private $table = "order_items";

	// object properties
	protected $id;
	protected $transaction_id;
	protected $product_id;
	protected $type_id;
	protected $price;
	protected $quantity;
}
