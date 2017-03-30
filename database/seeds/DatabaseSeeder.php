<?php

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;
use App\Models\Permission;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Task::create([
            'name' => 'Task 1',
            'description' => 'Create migration table and new records.',
        ]);

        Task::create([
            'name' => 'Task 2',
            'description' => 'Create a CRUD is working.',
        ]);

        //Create users data
        $admin = new User;
        $admin->id = 1;
        $admin->name = 'Administrator';
        $admin->email = 'admin@example.com';
        $admin->password = 'admin';
        $admin->save();

        $moderator = new User;
        $moderator->id = 2;
        $moderator->name = 'Moderator';
        $moderator->email = 'moderator@example.com';
        $moderator->password = 'moderator';
        $moderator->save();

        //Create roles data
        $roleAdmin = new Role;
        $roleAdmin->name = 'administrator';
        $roleAdmin->description = 'Full feature administrator and full permission.';
        $roleAdmin->save();
        $admin->roles()->attach($roleAdmin);

        $roleModerator = new Role;
        $roleModerator->name = 'moderator';
        $roleModerator->description = 'Moderator just few feature avaiable.';
        $roleModerator->save();
        $moderator->roles()->attach($roleModerator);

        //Create permissions data
        $manageDashboard = new Permission();
        $manageDashboard->name = "dashboard";
        $manageDashboard->display_name = "Dashboard";
        $manageDashboard->save();

        $manageProf = new Permission();
        $manageProf->name = "profile";
        $manageProf->display_name = "Update Profile";
        $manageProf->save();

        $manageRoles = new Permission();
        $manageRoles->name = 'view-role';
        $manageRoles->display_name = 'View Role';
        $manageRoles->save();

        $createRoles = new Permission();
        $createRoles->name = 'create-role';
        $createRoles->display_name = 'Create Role';
        $createRoles->save();

        $updateRoles = new Permission();
        $updateRoles->name = "update-role";
        $updateRoles->display_name = "Update Role";
        $updateRoles->save();

        $destroyRoles = new Permission();
        $destroyRoles->name = "destroy-role";
        $destroyRoles->display_name = "Delete Role";
        $destroyRoles->save();

        $manageUsers = new Permission();
        $manageUsers->name = "view-user";
        $manageUsers->display_name = "View  User";
        $manageUsers->save();

        $createUsers = new Permission();
        $createUsers->name = "create-user";
        $createUsers->display_name = "Create User";
        $createUsers->save();

        $updateUsers = new Permission();
        $updateUsers->name = "update-user";
        $updateUsers->display_name = "Update User";
        $updateUsers->save();

        $destroyUsers = new Permission();
        $destroyUsers->name = 'destroy-user';
        $destroyUsers->display_name = "Delete User";
        $destroyUsers->save();

        $managePerms = new Permission();
        $managePerms->name = "view-permission";
        $managePerms->display_name = "View Permission";
        $managePerms->save();

        $createPerms = new Permission();
        $createPerms->name = "create-permission";
        $createPerms->display_name = "Create Permission";
        $createPerms->save();

        $updatePerms = new Permission();
        $updatePerms->name = "update-permission";
        $updatePerms->display_name = 'Update Permission';
        $updatePerms->save();

        $destroyPerms = new Permission();
        $destroyPerms->name = "destroy-permission";
        $destroyPerms->display_name = 'Delete Permission';
        $destroyPerms->save();

        $permission1 = [$manageDashboard, $manageProf, $manageRoles, $createRoles, $updateRoles,
                        $destroyRoles, $manageUsers, $createUsers, $updateUsers, $destroyUsers, $managePerms,
                        $createPerms, $updatePerms, $destroyPerms];

        foreach($permission1 as $p) {
            $roleAdmin->permissions()->attach($p);
        }

        $permission2 = [$manageDashboard, $manageProf];

        foreach($permission2 as $ps) {
            $roleModerator->permissions()->attach($ps);
        }

        // $this->call(UserTableSeeder::class);
    }
}
