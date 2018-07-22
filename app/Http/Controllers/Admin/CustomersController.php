<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;

class CustomersController extends Controller
{
    private $customer;
    private $filter=['id'=>'ID','name'=>'Company'];
    private $order=['Asc'=>'Asc','Desc'=>'Desc'];

    public function __construct()
    {
        $this->customer = new Customer();
    }

    public function showCustomersTable(Request $request)
    {
        $query=$request->all();
        $query['filter']=$this->filter;
        $query['order']=$this->order;

        if(!isset($query['filter_col']))
            $query['filter_col']='id';
        if(!isset($query['order_by']))
            $query['order_by']='Desc';

        $customers = $this->customer->getByQuery($query);

        //下面这行和model里面的with那行作用是一样的，但是我竟然用了ajax来实现，太愚蠢了
        //$customers->load('contacts');

        return view('admin.customer',compact('customers'),compact('query'));
    }

    public function showCustomersAddForm(Request $request)
    {
        return view('admin.customer_edit');
    }

    public function showCustomersEditForm(Request $request, Customer $customer)
    {
        return view('admin.customer_edit', compact('customer'));
    }

    public function add(Request $request)
    {
        $result = $this->customer->addCustomer($request->all());

        flash('', __('messages.create.success'),'success');

        return redirect()->route('customers');
    }

    public function edit(Request $request, Customer $customer)
    {
        $result = $customer->update($request->all());

        flash('', __('messages.update.success'),'success');

        return redirect()->route('customers');
    }

    public function delete(Request $request)
    {
        //0 = fail   1 = success
        $result = $this->customer->removeCustomer($request['del_id']);

        if($result)
            flash('', __('messages.delete.success'),'success');
        else
            flash('', __('messages.delete.failure'),'danger');

        return back();
    }

    public function queryContacts(Request $request)
    {
        //这个方法和ContactsController中的同名方法效果是一样的
        $contacts = $this->customer->getContacts($request['id']);

        $output=__ajax('success');
        $output['contacts']=$contacts;

        return response()->json($output);
    }
}
