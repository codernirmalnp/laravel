<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;


class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manager = new Role();
        $manager->name = 'Project Manager';
        $manager->slug = 'project-manager';
        $manager->save();

        $developer = new Role();
        $developer->name = 'Web Developer';
        $developer->slug = 'web-developer';
        $developer->save();
    }
}
