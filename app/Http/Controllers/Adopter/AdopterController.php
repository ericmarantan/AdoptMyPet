<?php

namespace App\Http\Controllers\Adopter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adopter;
use App\Models\Order;
use Auth;
use Faker\Provider\ar_EG\Company;
use Illuminate\Support\Facades\DB;
use Validator;
use Hash;
use Session;

use function Laravel\Prompts\select;

class AdopterController extends Controller
{
    public function dashboard() {
        Session::put('page', 'dashboard');
        //return view("adopter.dashboard");

        $id = Auth::guard('adopter')->user()->id;

        $orders = DB::table('orders')
        ->join('items', 'orders.order_item', '=', 'items.id')
        ->orderBy('created_at', 'desc')
        ->where('orders.account_id', $id)
        ->get();

        $check = DB::table('orders')
                ->where('account_id', $id);

        $proc = DB::table('orders')
                ->where('account_id', $id);
        
        $comp = DB::table('orders')
                ->where('account_id', $id);

        $pending = $check->where('order_status', 'PENDING')->count();
        $processing = $proc->where('order_status', 'PROCESSING')->count();
        $completed = $comp->where('order_status', 'COMPLETED')->count();
        $totalCount = $orders->count();


        return view('adopter.dashboard', compact('orders', 'totalCount', 'pending', 'processing', 'completed'));
    }

    public function login(Request $request) {
        if ($request->isMethod("post")) {

            
            $data = $request->all();
            // //echo "<pre>"; print_r($data); die;

            $rules = [
                "email" => "required|email|max:255",
                "password" => "required|max:30",
            ];

            $customMessages = [
                "email.required" => "Email is required",
                "email.email" => "Valid email is required",
                "password.required" => "Password is required",
            ];

            $this->validate($request, $rules, $customMessages);


            if(Auth::guard('adopter')->attempt(['email'=>$data['email'],'password'=>$data['password']])) {
                return redirect("adopter/dashboard");

            } else {
                return redirect()->back()->with("error_message","Invalid Email or Password!");
            }
        }
        return view("adopter.login");
    }

    public function logout(Request $request)
    {
        Auth::guard("adopter")->logout();
        return redirect("adopter/login");
    }
    public function updatePassword(Request $request) {
        Session::put('page', 'update-password');
        
        return view("adopter.update_password");
    }

    public function updatePassbok(Request $request) {
        if ($request->isMethod('post')) {
            $data = $request->all();

            //check if password is correct
            if (Hash::check($data['current_pwd'],Auth::guard('adopter')->user()->password)) {

                if(empty($data['new_pwd'])) {
                    return response()->json([
                        'success' => 'false',
                        'error_message' => 'New password is empty!',
                    ]);
                } elseif(empty($data['confirm_pwd'])) {
                    return response()->json([
                        'success' => 'false',
                        'error_message' => 'Confirm password is empty!',
                    ]);
                } else {

                    //check if new password and confirm password is matching
                    if($data['new_pwd'] === $data['confirm_pwd']) {
                        //Update new password
                        Adopter::where('id', Auth::guard('adopter')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
                        //return redirect()->back()->with("success_message","Password has been updated successfully!");
                        
                        return response()->json([
                            'success' => 'true',
                            'success_message' => 'Password has been updated successfully!',
                        ]);

                    } else {
                        //return redirect()->back()->with("error_message","New password and confirm password are not match!");
                        return response()->json([
                            'error_message' => 'New password and confirm password are not match!',
                        ]);
                    }

                }

            } else {
                //return redirect()->back()->with("error_message","Your password is Incorrect!");
                return response()->json([
                    'error_message' => 'Your password is Incorrect!',
                ]);
            }
        }
    }

    public function checkCurrentPassword(Request $request) {
        $data = $request->all();
        if (Hash::check($data['current_pwd_adopter'], Auth::guard('adopter')->user()->password)) {
            return "true";
        } else {
            return "false";
        }

    }

    public function updateDetails(Request $request) {
        Session::put('page', 'update-details');
        return view('adopter.update_details');

    }

    public function updateDetailsAccount(Request $request) {
        if ($request->isMethod("post")) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;

            $rules = [
                'admin_name' => 'required|max:255',
                'admin_mobile' => 'required|numeric|digits:10',
            ];

            $customMessages = [
                "admin_name.required" => "Name is required",
                "admin_mobile.required" => "Mobile is required",
                "admin_mobile.numeric" => "Please enter a valid mobile phone number",
            ];

            $this->validate($request, $rules, $customMessages);
            
            //update admin details
            Adopter::where('email', Auth::guard('adopter')->user()->email)->update([
                'name' => $data['admin_name'],
                'company' => $data['admin_company'],
                'mobile' => $data['admin_mobile']]);

            //return redirect()->back()->with('success_message', 'Admin details has been updated successfully!');
            return response()->json([
                'success_message' => 'Account details has been updated successfully!',
            ]);
        }
    }

    public function updateAddress(Request $request) {
        if ($request->isMethod("post")) {
            $data = $request->all();
            

            if(empty($data['street_address'])) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'Street address is required!',
                ]);
            } elseif(empty($data['city'])) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'City is required!',
                ]);
            } elseif(empty($data['state'])) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'State is required!',
                ]);
            } else {

                Adopter::where('email', Auth::guard('adopter')->user()->email)->update([
                    'street_address' => $data['street_address'],
                    'city' => $data['city'],
                    'state' => $data['state']]);
      
                return response()->json([
                    'success' => true,
                    'success_message' => 'Address has been updated successfully!',
                ]);
            }
        }
    }

    public function registerAdopter(Request $request) {
        Session::put('page', 'register');
        if ($request->isMethod("post")) {
            $data = $request->all();
        }

        return view('adopter.register_adopter');
    }

    public function orderNewTag(Request $request) {
        Session::put('page', 'order-new-tag');

        function generateRandomNumber($length = 5) {
            $number = '1234567890';
            $numberLength = strlen($number);
            $randomNumber = '';
            for ($i = 0; $i < $length; $i++) {
                $randomNumber .= $number[rand(0, $numberLength - 1)];
            }
            return $randomNumber;
        }
        $numbers = "CDT" .generateRandomNumber();

        //GET ITEM LIST
        $items = DB::table('items')->get();

        return view('adopter.order-tag', compact('numbers', 'items'));

    }

    public function checkPrice(Request $request) {

        $data = $request->all();

        $checkprices = DB::table('items')
        ->select('product_price')
        ->where('id', $data['id'])
        ->get();

        return response()->json([
            'price' => $checkprices,
        ]);
    }

    public function orderSubmit(Request $request) {
        if ($request->isMethod("post")) {
            $data = $request->all();



            if(empty($data['mailing_adopter_name'])) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'Fullname is required!',
                ]);
            } elseif(empty($data['mailing_email'])) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'Email address is required!',
                ]);
            } elseif(empty($data['mailing_street_address'])) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'Street address is required!',
                ]);
            } elseif(empty($data['mailing_city_state'])) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'City is required!',
                ]);
            } elseif(empty($data['adopter_name'])) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'Adopters name is required!',
                ]);
            } elseif(empty($data['phone'])) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'Phone is required!',
                ]);
            } elseif(empty($data['street'])) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'Mailing street is required!',
                ]);
            } elseif(empty($data['city'])) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'City is required!',
                ]);
            
            } elseif(empty($data['shape']) OR !isset($data['shape'])) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'Please choose the shape!',
                ]);
            }
             else {

                if(empty($data['mailing_note'])) {
                    $data['mailing_note'] = "";
                }

                Order::create([
                    'order_number' => $data['id'],
                    'order_item' => '1',
                    'shape' => $data['shape'],
                    'qty' => '1',
                    'price' => $data['price'],
                    'account_id' => $data['accountId'],
                    'account_name' => $data['company'],
                    'company_street' => $data['company_street'],
                    'company_city' => $data['company_city'],
                    'adopter_name' => $data['adopter_name'],
                    'adopter_phone' => $data['phone'],
                    'adopter_address' => $data['street'],
                    'adopter_city_state' => $data['city'],
                    'mailing_name' => $data['mailing_adopter_name'],
                    'mailing_email' => $data['mailing_email'],
                    'mailing_street_address' => $data['mailing_street_address'],
                    'mailing_city_state_zip' => $data['mailing_city_state'],
                    'mailing_note' => $data['mailing_note'],
                    'order_status' => 'PENDING',
                    'status' => '1'
                ]);

                return response()->json([
                    'success' => true,
                    'success_message' => 'Your Order was submitted successfully!',
                ]);
            }

            

        }
    }

    public function manageOrder() {
        Session::put('page', 'manage-orders');

        $id = Auth::guard('adopter')->user()->id;

        $orders = DB::table('orders')
            ->join('items', 'orders.order_item', '=', 'items.id')
            ->where('orders.account_id', $id)
            ->get();
        return view('adopter.manage-orders', compact('orders'));
    }

    public function orderDetails(Request $request) {
        $check = DB::table('orders')
            ->join('items', 'orders.order_item', '=', 'items.id')
            ->where('order_id', $request->id)
            ->get();
        return $check[0];
    }

    // public function checkDetails(Request $request) {
    //     $check = DB::table('orders')
    //         ->join('items', 'orders.order_item', '=', 'items.id')
    //         ->where('order_id', $request->id)
    //         ->get();
    //     return $check;
    // }

}
