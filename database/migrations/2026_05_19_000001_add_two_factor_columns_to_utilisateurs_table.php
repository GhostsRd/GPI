<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTwoFactorColumnsToUtilisateursTable extends Migration
{
    public function up()
    {
        Schema::table('utilisateurs', function (Blueprint $table) {
            if (!Schema::hasColumn('utilisateurs', 'two_factor_code')) {
                $table->string('two_factor_code')->nullable()->after('password');
            }
            if (!Schema::hasColumn('utilisateurs', 'two_factor_expires_at')) {
                $table->dateTime('two_factor_expires_at')->nullable()->after('two_factor_code');
            }
            if (!Schema::hasColumn('utilisateurs', 'two_factor_enabled')) {
                $table->boolean('two_factor_enabled')->default(false)->after('two_factor_expires_at');
            }
            if (!Schema::hasColumn('utilisateurs', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('two_factor_enabled');
            }
            if (!Schema::hasColumn('utilisateurs', 'remember_token')) {
                $table->rememberToken()->after('is_active');
            }
        });
    }

    public function down()
    {
        Schema::table('utilisateurs', function (Blueprint $table) {
            $table->dropColumn([
                'two_factor_code',
                'two_factor_expires_at',
                'two_factor_enabled',
                'is_active',
                'remember_token',
            ]);
        });
    }
}
