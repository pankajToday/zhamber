<?php
use App\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $admin_user = Admin::create([
			'name' => 'System Admin', 
			'email' => 'admin@admin.com',
			'password' => bcrypt('password'),
			'mobile' => 9999999999,
      	 ]);
        
        $super_admin = Role::create(['name' => 'super_admin','guard_name' => 'admin']);
        $permissions = Permission::pluck('id','id')->all();
        $super_admin->syncPermissions($permissions);
        $admin_user->assignRole([$super_admin->id]);
        
    }
}


