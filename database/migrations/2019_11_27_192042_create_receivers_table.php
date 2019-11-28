<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiversTable extends Migration
{
    public static $table_name = "receivers";

    public function up()
    {
        Schema::create(self::$table_name, function(Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("name");
            $table->string("surname");
            $table->string("email")->unique();
            $table->string("telephone_number")->nullable();
            $table->string("telegram_account")->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists(self::$table_name);
    }
}
