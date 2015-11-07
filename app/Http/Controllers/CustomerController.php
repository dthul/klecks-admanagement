<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $validation_rules = [
        'name' => 'string|required|max:256',
        'address' => 'string|required|max:1024',
        'telephone' => 'string|max:256',
        'email' => 'string|max:1024',
        'comments' => 'string|max:10000'
    ];

    public function showAll()
    {
        return view('customers.index', ['customers' => Customer::all()]);
    }

    public function create(Request $request)
    {
        $this->validate($request, $this->validation_rules);
        Customer::create($request->all());
        return redirect()->route('customers.index');
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $this->validate($request, $this->validation_rules);
        $customer->update($request->all());
        $customer->save();
        return redirect()->route('customers.index');
    }

    public function delete($id)
    {
        $customer = Customer::findOrFail($id);
        if ($customer->advertisements()->count() > 0)
            return redirect()->route('customers.index')->withErrors(['alert' => 'Der Kunde kann nicht gelöscht werden, da Anzeigen zu ihm existieren.']);
        $customer->delete();
        return redirect()->route('customers.index');
    }
}
