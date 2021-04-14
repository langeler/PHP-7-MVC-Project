<?php

namespace App\Models;

use App\Core\Model as Model;

class Order extends Model
{
	private $table = "orders";

    // object properties
	protected $id;
	protected $transaction_id;
	protected $user_id;
	protected $total;
	protected $tax;
	protected $status;
	
	
}