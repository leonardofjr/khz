<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Address;
use App\ShipmentAddress;
use App\BillingAddress;
use App\Studio;
use App\Order;
use App\Product;
use App\OrderDetails;
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
            'fname' => 'Fernando',
            'email' => 'fernando@webmaster.com',
            'password' => bcrypt('password'),
        ]);

        $user = User::create([
            'fname' => 'Miguel',
            'email' => 'miguel@webmaster.com',
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


        $miguel = User::where('email', 'fernando@webmaster.com')->first();

        $address->user()->associate($miguel);
        $address->save();


        $first_address = Address::where('user_id', $miguel->id)->first();

        $shipment_address->address()->associate($first_address);

        $shipment_address->save();
  

        $billing_address = BillingAddress::create($address_data);

        $billing_address->address()->associate($first_address);
        $billing_address->save();
     
    for($i = 0; $i < 6; $i++) {

        $order = Order::create();
        $order->user()->associate($first_address);
        $order->save();


        $faker = Faker::create();

        /* Inserting Product Data */
            $product = Product::create([
                'user_id' => 2,
                'name' => $faker->name,
                'sku' => $faker->randomNumber,
                'stock_status' => 'in_stock',
                'slug' => $faker->word,
                'track_filename' => 'asa',
                'details' => $faker->sentence,
                'description' => $faker->paragraph(3),
                'price' => $faker->randomFloat(2, 1, 50),
            ]);
            $product->save();

 



        /* Inserting Order Details Data */
        $order_details = OrderDetails::create([

        ]);
        $order_details->product()->associate($product->id);
        $order_details->order()->associate($order->id);

        $order_details->save();
        

        $order->shipment_address()->associate($address->id);
        $order->user()->associate($miguel->id);
        $order->save();
    }

        $user->testDatabase();


    }
}
