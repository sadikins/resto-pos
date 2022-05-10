<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Customer;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class CustomerController extends Controller
{
    public function index ()
    {
        return Inertia::render('Admin/Customers/Index',[
            'customers' => Customer::when(request()->q, function($customers){
                $customers = $customers->where('name','like','%'.request()->q.'%');
            })->latest()->paginate(5),
        ]);
        
    }


    public function create()
    {
        return Inertia::render('Admin/Customers/Create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required',
            'phone'   => 'required|unique:customers',
            'address' => 'required',
        ]);


        Customer::create([
            'name'    => $request->name,
            'phone'   => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('customers.index');
    }

    public function edit(Customer $customer)
    {

        return Inertia::render('Admin/Customers/Edit', [
            'customer' => $customer,
        ]);

    }

    public function update(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'name'    => 'required',
            'phone'   => 'required|unique:customers,phone,'.$customer->id,
            'address' => 'required'
        ]);

        $customer->update([
            'name'    => $request->name,
            'phone'   => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('customers.index');
    }

    public Function destroy($id)
    {
        $customer  = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('customers.index');
    }


}
