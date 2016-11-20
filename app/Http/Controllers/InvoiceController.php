<?php

namespace App\Http\Controllers;

use App\Issue;
use App\Customer;
use App\Advertisement;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($issue_id, $customer_id)
    {
        $issue = Issue::findOrFail($issue_id);
        $customer = Customer::findOrFail($customer_id);
        $advertisements = Advertisement::
            where('customer_id', '=', $customer_id)->
            whereHas('adformat', function($q) use ($issue_id) {
                $q->where('issue_id', '=', $issue_id);
            })->
            get();
        return view('layouts.invoice', ['issue' => $issue, 'customer' => $customer, 'advertisements' => $advertisements]);
    }
}
