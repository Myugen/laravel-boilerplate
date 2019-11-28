<?php

use App\Enums\DeliveryChannel;
use App\Enums\NotificationState;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public static $table_name = "notifications";

    public function up()
    {
        Schema::create(self::$table_name, function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->enum("state", NotificationState::getValues())->nullable();
            $table->enum("channel", DeliveryChannel::getValues());
            $table->integer("delivery_attempts")->default(0);
            $table->unsignedBigInteger("message_fk");
            $table->unsignedBigInteger("receiver_fk");
            $table->timestamps();

            //Constraints
            $table->foreign("message_fk")
                ->references("id")
                ->on(CreateMessagesTable::$table_name)
                ->onDelete("cascade");
            $table->foreign("receiver_fk")
                ->references("id")
                ->on(CreateReceiversTable::$table_name)
                ->onDelete("cascade");
        });
    }

    public function down()
    {
        Schema::dropIfExists(self::$table_name);
    }
}
