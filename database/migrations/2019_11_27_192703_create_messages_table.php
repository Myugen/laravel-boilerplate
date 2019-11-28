<?php

use App\Enums\MessageState;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public static $table_name = "messages";

    public function up()
    {
        Schema::create(self::$table_name, function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("title");
            $table->string("body");
            $table->enum("state", MessageState::getValues())->default(MessageState::DRAFT);
            $table->string("created_by");
            $table->string("updated_by");
            $table->string("sent_by")->nullable();
            $table->timestamps();
            $table->timestamp("sent_at")->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists(self::$table_name);
    }
}
