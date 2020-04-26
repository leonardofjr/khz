<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Address;
use App\ShipmentAddress;
use App\BillingAddress;
use App\Studio;
use App\Geopoint;
use Faker\Factory as Faker;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        
        $adminRole = Role::where('name', 'admin')->first();
        $producerRole = Role::where('name', 'producer')->first();
        $userRole = Role::where('name', 'user')->first();

        /* Getting geopoints table data */
  
        /* Getting studios table data */

       /* Creating user table data */ 
        $admin = User::create([
            'fname' => 'Leo',
            'email' => 'leo@webmaster.com',
            'password' => bcrypt('password'),
        ]);

        $producer = User::create([
            'fname' => 'Miguel',
            'email' => 'miguel@webmaster.com',
            'password' => bcrypt('password'),
        ]);

        $user = User::create([
            'fname' => 'Fernando',
            'email' => 'fernando@webmaster.com',
            'password' => bcrypt('password'),
        ]);

        $address_data =[
            'address_1' => '188 Bur Oak Avenue',
            'address_2' => '7',
            'city' => 'Markham',
            'postal_code' => 'L6C 2M1',
            'province' => 'ONtario',
            'country' => 'Canada',
        ];



        $admin->roles()->attach($adminRole);
        $producer->roles()->attach($producerRole);
        $user->roles()->attach($userRole);

        $address = Address::create($address_data);
        $shipment_address = ShipmentAddress::create($address_data);


        $miguel = User::where('email', 'miguel@webmaster.com')->first();

        $address->user()->associate($miguel);
        $address->save();


        $first_address = Address::where('user_id', 2)->first();

        $shipment_address->address()->associate($first_address);
        $shipment_address->save();

        $billing_address = BillingAddress::create($address_data);

        $billing_address->address()->associate($first_address);
        $billing_address->save();
     

        $user->testDatabase();


    }
}
