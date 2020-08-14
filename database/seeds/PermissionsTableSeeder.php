<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        
Permission::create(['name' => 'role-list', 'text' => 'List of Roles', 'guard_name' => 'admin','module' => 'system_users']);
Permission::create(['name' => 'role-create','text' => 'Create New Role ','guard_name' => 'admin','module' => 'system_users']);
Permission::create(['name' => 'role-edit','text' => 'Edit Role','guard_name' => 'admin','module' => 'system_users']);
Permission::create(['name' => 'role-delete','text' => 'Delete Role','guard_name' => 'admin','module' => 'system_users']);

Permission::create(['name' => 'systemuser-list','text' => 'List Of System Users','guard_name' => 'admin','module' => 'system_users']);
Permission::create(['name' => 'systemuser-create','text' => 'Create System User','guard_name' => 'admin','module' => 'system_users']);
Permission::create(['name' => 'systemuser-edit','text' => 'Edit System User','guard_name' => 'admin','module' => 'system_users']);
Permission::create(['name' => 'systemuser-show','text' => 'View System User Detail ','guard_name' => 'admin','module' => 'system_users']);

Permission::create(['name' => 'user-list','text' => 'list Of Customer','guard_name' => 'admin','module' => 'users']);
Permission::create(['name' => 'user-create','text' => 'Create New Customer','guard_name' => 'admin','module' => 'users']);
Permission::create(['name' => 'user-edit','text' => 'Edit/Update Customer Detail ','guard_name' => 'admin','module' => 'users']);
Permission::create(['name' => 'user-show','text' => 'View User Customer','guard_name' => 'admin','module' => 'users']);



Permission::create(['name' => 'post-list','text' => 'list Of post','guard_name' => 'admin','module' => 'posts']);
Permission::create(['name' => 'post-create','text' => 'Create New post','guard_name' => 'admin','module' => 'posts']);
Permission::create(['name' => 'post-edit','text' => 'Edit/Update post ','guard_name' => 'admin','module' => 'posts']);
Permission::create(['name' => 'post-remove','text' => 'Remove post ','guard_name' => 'admin','module' => 'posts']);
Permission::create(['name' => 'post-show','text' => 'View post detail','guard_name' => 'admin','module' => 'posts']);

Permission::create(['name' => 'tag-show','text' => 'View post detail','guard_name' => 'admin','module' => 'posts']);




        


        

    }
}
