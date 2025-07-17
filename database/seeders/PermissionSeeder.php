<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            'access dashboard',

            'impersonate',

            'view users',
            'create users',
            'update users',
            'delete users',

            'view roles',
            'create roles',
            'update roles',
            'delete roles',

            'view permissions',
            'create permissions',
            'update permissions',
            'delete permissions',

            'access teacher dashboard',
            'view kelas', 'create kelas', 'update kelas', 'delete kelas',
            'view jurusan', 'create jurusan', 'delete jurusan',
            'view konselings student', 'create konselings', 'update konselings', 'delete konselings',
            'view catatan teacher', 'create catatan', 'update catatan', 'delete catatan',
            'view surat panggilan', 'create surat panggilan', 'update surat panggilan', 'delete surat panggilan',
            'view biodata student','download kelas', 'download catatan', 'download konselings', 'download surat panggilan', 'download biodata',

            'access student dashboard',
            'view biodata', 'create biodata', 'update biodata',
            'view konselings', 'create konselings', 'update konselings',
            'view catatan student',
        ];

        foreach ($permissions as $permission) {
            Permission::query()->updateOrCreate([
                'name' => $permission,
            ]);
        }

    }
}
