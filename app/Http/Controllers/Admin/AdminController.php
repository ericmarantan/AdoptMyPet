<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Adopter;
use Illuminate\Support\Facades\DB;
use Auth;
use Validator;
use Hash;
use PhpParser\Node\Expr\Cast\Object_;
use Session;

class AdminController extends Controller
{
    public function dashboard() {
        Session::put('page', 'dashboard');

        $id = Auth::guard('admin')->user()->id;

        $orders = DB::table('orders')
        ->join('items', 'orders.order_item', '=', 'items.id')
        ->orderBy('created_at', 'desc')
        ->get();

        $recent = $orders->take(5);

        $latest = $orders->take(10);

        $check = DB::table('orders');

        $proc = DB::table('orders');
        
        $comp = DB::table('orders');

        $pending = $check->where('order_status', 'PENDING')->count();
        $processing = $proc->where('order_status', 'PROCESSING')->count();
        $completed = $comp->where('order_status', 'COMPLETED')->count();
        $totalCount = $orders->count();


        return view('admin.dashboard', compact('latest', 'totalCount', 'pending', 'processing', 'completed', 'recent'));
        //return view("admin.dashboard");
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


            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])) {
                return redirect("admin/dashboard");

            } else {
                return redirect()->back()->with("error_message","Invalid Email or Password!");
            }
        }
        return view("admin.login");
    }

    public function logout(Request $request)
    {
        Auth::guard("admin")->logout();
        return redirect("admin/login");
    }

    public function updatePassword(Request $request) {
        Session::put('page', 'update-password');
        if ($request->isMethod('post')) {
            $data = $request->all();

            //check if password is correct
            if (Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)) {
                //check if new password and confirm password is matching
                if($data['new_pwd'] === $data['confirm_pwd']) {
                    //Update new password
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
                    return redirect()->back()->with("success_message","Password has been updated successfully!");

                } else {
                    return redirect()->back()->with("error_message","New password and confirm password are not match!");
                }
            } else {
                return redirect()->back()->with("error_message","Your password is Incorrect!");
            }
        }
        return view("admin.update_password");
    }

    public function checkCurrentPassword(Request $request) {
        $data = $request->all();
        if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }

    }

    public function updateDetails(Request $request) {
        Session::put('page', 'update-details');
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
            Admin::where('email', Auth::guard('admin')->user()->email)->update([
                'name' => $data['admin_name'],
                'mobile' => $data['admin_mobile']]);

            return redirect()->back()->with('success_message', 'Admin details has been updated successfully!');
        }

        return view('admin.update_details');

    }

    public function registerAccount(Request $request) {
        Session::put('page', 'register-account');
        if ($request->isMethod("post")) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;

            $rules = [
                'admin_name' => 'required|max:255',
                'admin_mobile' => 'required|numeric|digits:10',
                'company' => 'required|max:255',
                'email' => 'required|email',
                'password' => [
                    'required',
                    'string',
                    // 'min:10',             // must be at least 10 characters in length
                    // 'regex:/[a-z]/',      // must contain at least one lowercase letter
                    // 'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    // 'regex:/[0-9]/',      // must contain at least one digit
                    // 'regex:/[@$!%*#?&]/', // must contain a special character
                ],
            ];

            $customMessages = [
                "admin_name.required" => "Name is required",
                "admin_mobile.required" => "Mobile is required",
                "admin_mobile.numeric" => "Please enter a valid mobile phone number",
                "email.required" => "Email is required",
                "password.required" => "Password is required",
                //"password.min" => "must be at least 8 characters in length",
                // "password.regex:/[a-z]/" => "must contain at least one lowercase letter",
                // "password.regex:/[A-Z]/" => "must contain at least one uppercase letter",
                // "password.regex:/[0-9]/" => "must contain at least one digit",
                // "password.regex:/[@$!%*#?&]/" => "must contain a special character",
            ];

            $this->validate($request, $rules, $customMessages);

            Adopter::where('email', Auth::guard('admin')->user()->email)->create([
                'name' => $data['admin_name'],
                'type' => 'Organization',
                'company' => $data['company'],
                'street_address' => '',
                'city' => '',
                'state' => '',
                'mobile' => $data['admin_mobile'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'image' => 'no-name.jpg',
                'status' => '0'
            ]);

            return redirect()->back()->with('success_message', 'User has been created successfully!');

        }

        return view('admin.register_account');

    }

    public function accountList() {
        Session::put('page', 'manage-account');
        $accounts = Adopter::get();
        return view('admin.accounts', compact('accounts'));
    }

    public function manageOrder() {
        Session::put('page', 'manage-orders');
        $orders = DB::table('orders')
            ->join('items', 'orders.order_item', '=', 'items.id')
            ->get();

        return view('admin.orders', compact('orders'));
    }

    public function manageInvoice() {
        Session::put('page', 'manage-invoices');
        $accounts = Admin::get();
        return view('admin.invoices', compact('accounts'));
    }

    public function deleteUser(Request $request) {
        Adopter::destroy($request->id);
        return response()->json([
            'success_message' => 'Account deleted successfully!',
        ]);
    }

    public function viewAccountDetails(Request $request) {
        
        $data = $request->all();
        $viewDetails = Adopter::where('id', $data['id'])->get();
        return $viewDetails[0];
    }

    public function updateStatus(Request $request) {

        $data = $request->all();

        Adopter::where('email', Auth::guard('admin')->user()->email)->update([
                'status' => $data['id']]);

        return response()->json([
            'success_message' => 'Account updated successfully!',
        ]);
       
    }

    public function deleteOrder(Request $request) {

        $data = $request->all();
        $did = $data['id'];

        DB::table('orders')
            ->where('order_id', $did)->delete();

        return response()->json([
            'success_message' => 'Order has been deleted!',
        ]);
    }

    public function viewOrderDetails(Request $request) {
        $data = $request->all();
        $id = $data['id'];

        $view = DB::table('orders')->where('order_id', $id)->get();

        $res = $view[0];
        return $res;

        //return view('admin.orders', compact('res'));
    }


}
