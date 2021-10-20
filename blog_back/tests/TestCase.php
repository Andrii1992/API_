<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Permission\Models\Role;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function signInUser($user = null)
    {

       // first include all the normal setUp operations
        parent::setUp();

        // now re-register all the roles and permissions (clears cache and reloads relations)
        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
        $role = Role::create(['name' => 'user']);
        $user = $user ?: User::factory()->create();
        $user->assignRole('user');
        $this->actingAs($user);
        // $user->assignRole('user');
        // print( $user->getRole());
        //  $this->actingAs($user);
        return $user;
    }
    protected function signInAdmin($user = null)
    {
        // first include all the normal setUp operations
        parent::setUp();
        // now re-register all the roles and permissions (clears cache and reloads relations)
        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
        $role = Role::create(['name' => 'admin']);
        $user = $user ?: User::factory()->create();

        // $user[0]->assignRole('user');
        $user->assignRole('admin');
        $this->actingAs($user);
        // $user->assignRole('user');
        // print( $user->getRole());
        //  $this->actingAs($user);
        return $user;
    }

    /*
    protected function signInAdmin($user = null)
    {
        $user = $user ?: User::factory()->create();
        $user->assignRole('admin');
        $this->actingAs($user);

        return $user;
    }*/
}
