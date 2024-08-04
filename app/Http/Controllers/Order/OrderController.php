<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Auth;
use Faker\Provider\ar_EG\Company;
use Validator;
use Hash;
use Session;

class OrderController extends Controller
{
    public function orderSubmit(Request $request) {
        if ($request->isMethod("post")) {
            $data = $request->all();
            //echo $data['id'];

            // company
            // company_street
            // company_city
            // adopter_name
            // phone
            // street
            // city

            // mailing_adopter_name
            // mailing_street_address
            // mailing_city_state
            // mailing_note

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
            } else {

                Order::create([
                    'order_number' => $data['id'],
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
}
