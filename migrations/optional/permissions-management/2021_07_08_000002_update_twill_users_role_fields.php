<?php

use A17\Twill\Models\Role;
use A17\Twill\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTwillUsersRoleFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $twillUsersTable = config('twill.users_table', 'twill_users');

        if (Schema::hasTable($twillUsersTable)) {
            Schema::table($twillUsersTable, function (Blueprint $table) {
                $table->unsignedInteger('role_id')->nullable();
                $table->boolean('is_superadmin')->default(false);
            });

            $this->convertLegacyRoles();

            Schema::table($twillUsersTable, function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $twillUsersTable = config('twill.users_table', 'twill_users');

        if (Schema::hasTable($twillUsersTable)) {
            Schema::table($twillUsersTable, function (Blueprint $table) {
                $table->dropColumn('role_id');
                $table->dropColumn('is_superadmin');
                $table->string('role', 100);
            });
        }
    }

    private function convertLegacyRoles()
    {
        $roleMap = [
            'ADMIN' => Role::where(['name' => 'Owner'])->first(),
            'PUBLISHER' => Role::where(['name' => 'Administrator'])->first(),
            'VIEWONLY' => Role::where(['name' => 'Guest'])->first(),
        ];

        User::chunk(100, function ($users) use ($roleMap) {
            foreach ($users as $user) {
                if ($user->role === 'SUPERADMIN') {
                    $user->is_superadmin = true;
                }

                if ($newRole = $roleMap[$user->role] ?? false) {
                    $user->role_id = $newRole->id;
                }

                $user->save();
            }
        });
    }
}
