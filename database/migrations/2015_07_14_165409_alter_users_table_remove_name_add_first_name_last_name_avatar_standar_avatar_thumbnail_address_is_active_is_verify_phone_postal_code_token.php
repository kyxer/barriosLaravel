<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTableRemoveNameAddFirstNameLastNameAvatarStandarAvatarThumbnailAddressIsActiveIsVerifyPhonePostalCodeToken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table){
            $table->dropColumn('name');
            $table->string('first_name', 50)->after('id');
            $table->string('last_name', 50)->after('first_name');
            $table->string('avatar_standar', 255)->after('last_name');
            $table->string('avatar_thumbnail', 255)->after('avatar_standar');
            $table->string('phone', 50)->after('avatar_thumbnail');
            $table->string('address', 255)->after('phone');
            $table->smallInteger('postal_code');
            $table->boolean('is_active')->default(1);
            $table->boolean('is_verify')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table){
            $table->dropColumn('last_name');
            $table->dropColumn('first_name');
            $table->dropColumn('avatar_standar');
            $table->dropColumn('avatar_thumbnail');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('postal_code');
            $table->dropColumn('is_active');
            $table->dropColumn('is_verify');
            $table->string('name')->after('id');
        });
    }
}
