<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    private $validation_rules = [
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
        $this->validate($request, $this->validation_rules + [
            'name' => 'string|required|max:256',
        ]);
        Customer::create($request->only('name', 'address', 'telephone', 'email', 'comments'));
        return redirect()->route('customers.index');
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $this->validate($request, $this->validation_rules + [
            'name' => [
                'string', 'required', 'max:256',
                Rule::unique('customers')->ignore($id),
            ],
        ]);
        $customer->update($request->only('name', 'address', 'telephone', 'email', 'comments'));
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
