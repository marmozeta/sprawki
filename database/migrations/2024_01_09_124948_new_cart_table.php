<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Element;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->foreignIdFor(Order::class);
            $table->foreignIdFor(User::class);
            $table->string('comments');
            $table->string('payment_token');
            $table->softDeletes();
            $table->timestamps();
        });
        
        Schema::create('cart_items', function (Blueprint $table) {
            $table->foreignIdFor(OrderItem::class);
            $table->foreignIdFor(Cart::class);
            $table->foreignIdFor(Element::class);
            $table->float('price');
            $table->integer('quantity');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
        Schema::dropIfExists('cart_items');
    }
};
