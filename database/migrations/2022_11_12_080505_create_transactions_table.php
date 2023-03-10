<?php

use App\Models\Cashier;
use App\Models\Customer;
use App\Models\Kitchen;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Cashier::class);
            $table->foreignIdFor(Customer::class);
            $table->foreignIdFor(Kitchen::class)->nullable();
            $table->string('tax');
            $table->string('grand_total');
            $table->enum('status', ['order', 'cooking', 'serve', 'reject']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
