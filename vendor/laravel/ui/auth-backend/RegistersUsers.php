<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Customer;
use Session;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // dd($request->all());
        $cart_data = session()->get('cart');
        $order_data = session()->get('order_session');
        // dd($cart_data);
        // dd($order_data);

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $user = User::orderBy('id','Desc')->first();
        if($cart_data !== null) {
            foreach($cart_data as $id => $variation){
                foreach ($variation as $key => $product){
                    if($key != null){
                        $cart = new Cart;
                        $cart->customer_id = $user->id;
                        $cart->product_id = $product['id'];
                        $cart->variation_title = $product['variation_title'];
                        $cart->variation_value = $product['variation_value'];
                        $cart->quantity = 1;
                        $cart->price = $product['price'];
                        $cart->sub_total = (int)$product['quantity'] * (int)$product['price'];
                        $cart->save();
                    }
                }
            }
        }
        if($order_data !== null){
            foreach($order_data as $key => $data){
                $order = Order::where('id',$data)->first();
                $order->customer_id = $user->id;
                $order->save();
            }
        }

        $customer = Customer::where('email',$request->email)->first();
        if($customer == null){
            $customer = new Customer;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->save();
        }else{
            if($customer->city == null){
                $customer->name = $request->name;
                $customer->save();
            }
        }
        Session::flush();

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
