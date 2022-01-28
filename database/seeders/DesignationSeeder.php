<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Designation;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $designations =  array(
            array('designation'=>'Developer'),
            array('designation'=>'UI/UX Developer'),
            array('designation'=>'HR'),
            array('designation'=>'Manager'),
        );
        foreach ($designations as $designation) {
            Designation::create($designation);
        }
          

    }
}
