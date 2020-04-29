<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\OrderDetails;
use App\Geopoint;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getProducers() {
        $producers = User::all();
        $data = [];
        foreach ($producers as $key => $producer ) {

            if ($producer->roles->first()['name'] == 'producer') {

             array_push($data, [
                'user' => $producer,
                'role' => $producer->roles->first(),
                'studio' => $producer->studio,
             ]);
            }
        }

        return response()->json(
            $data
        );
    }
    public function index()
    {
        $user_id = Auth::id();
        $user = User::with(['roles', 'address', 'address.shipment_address', 'address.billing_address'])->where('id', $user_id)->first();
        $user['authenticated'] = Auth::check();
        return response()->json(
           $user
        );
    }

    public function products() {
        $order_details = Product::where('user_id', 2)->paginate(2);
        return response()->json($order_details);
    }

    public function order_details($id) {
        $order_details = OrderDetails::with(['product', 'order', 'order.user', 'order.shipment_address'])->where('id', $id)->first();
        return response()->json($order_details);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = UserGeopoint::get();
        dd($user);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
