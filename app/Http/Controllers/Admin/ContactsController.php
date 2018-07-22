<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;
use App\Customer;
use App\Title;

class ContactsController extends Controller
{
    private $contact;
    private $filter=['id'=>'ID','name'=>'Name'];
    private $order=['Asc'=>'Asc','Desc'=>'Desc'];

    public function __construct()
    {
        $this->contact = new Contact();
    }

    public function showContactsTable(Request $request)
    {
        $query=$request->all();
        $query['filter']=$this->filter;
        $query['order']=$this->order;

        if(!isset($query['filter_col']))
            $query['filter_col']='id';
        if(!isset($query['order_by']))
            $query['order_by']='Desc';

        $contacts = $this->contact->getByQuery($query);

        $contacts->load('customer','title');

        return view('admin.contact',compact('contacts'),compact('query'));
    }

    public function showContactsAddForm(Request $request)
    {
        $customer_id = null;
        $customer_name = null;
        $customers = Customer::select('id', 'name')->get();
        $titles= Title::get();

        if(isset($request['customer'])){
            $get_id = $request['customer'];
            foreach ($customers as $customer){
                if( $customer->id == $get_id) {
                    $customer_id = $customer->id;
                    $customer_name =$customer->name;
                    break;
                }
            }
        }

        $extra=['customer_id'=>$customer_id,'customer_name'=>$customer_name,'customers'=>$customers,'titles'=>$titles];

        return view('admin.contact_edit', compact('extra'));
    }

    public function showContactsEditForm(Request $request, Contact $contact)
    {
        $customers = Customer::select('id', 'name')->get();
        $titles= Title::get();

        $extra=['customers'=>$customers,'titles'=>$titles];

        return view('admin.contact_edit', compact('contact'), compact('extra'));
    }

    public function add(Request $request)
    {
        $result = $this->contact->addContact($request->all());

        flash('', __('messages.create.success'),'success');

        return redirect()->route('contacts');
    }

    public function edit(Request $request, Contact $contact)
    {
        $result = $contact->update($request->all());

        flash('', __('messages.update.success'),'success');

        return redirect()->route('contacts');
    }

    public function delete(Request $request)
    {
        //0 = fail   1 = success
        $result = $this->contact->removeContact($request['del_id']);

        if($result)
            flash('', __('messages.delete.success'),'success');
        else
            flash('', __('messages.delete.failure'),'danger');

        return back();
    }

    public function queryContacts(Request $request)
    {
        // 这个方法和CustomerController中的同名方法效果是一样的
        $customer_id = $request['id'];

        $contacts = $this->contact->where('customer_id', $customer_id)->get();

        $output=__ajax('success');
        $output['contacts']=$contacts;

        return response()->json($output);
    }
}
