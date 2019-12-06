<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentDetails;

class PaymentController extends Controller
{
    public function index() {
    	return view("razorpay");
    }
    public function store(Request $request) {
    	// dd($request->all());
    	$data = new PaymentDetails();
    	
    	$data->product = $request->product;
    	$data->email = $request->email;
    	$data->mobile = $request->mobile;
    	$data->amount = $request->amount;
    	$data->payment_id = $request->razorpay_id;
    	$data->save();
    	$status= "success";
    	return $status;
    }

    public function thankYouBlade(Request $request) {
    	return view("thankYouBlade");
    }
}
