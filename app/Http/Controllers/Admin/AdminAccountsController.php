<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\AdminAccount;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddAdminUserRequest;

class AdminAccountsController extends Controller
{
    //
    private $admin_account;
    private $filter=['id'=>'ID','user_name'=>'User Name','admin_type'=>'Admin Type'];
    private $order=['Asc'=>'Asc','Desc'=>'Desc'];

    public function __construct()
    {
        $this->admin_account = new AdminAccount();
    }

    public function showAdminsTable(Request $request)
    {
//        $user=$request->user();

        $query=$request->all();
        $query['filter']=$this->filter;
        $query['order']=$this->order;

        if(!isset($query['filter_col']))
            $query['filter_col']='id';
        if(!isset($query['order_by']))
            $query['order_by']='Desc';

        $admins = $this->admin_account->getByQuery($query);

        return view('admin.admin_account',compact('admins'),compact('query'));
    }

    public function showAdminsAddForm(Request $request)
    {
        return view('admin.admin_edit');
    }

    public function showAdminsEditForm(Request $request, AdminAccount $admin_account)
    {
        $admin = $admin_account;

        $isSelf = ($request->user()->id == $admin_account->id)? true: false;

        return view('admin.admin_edit', compact('admin'), compact('isSelf'));
    }

    public function add(AddAdminUserRequest $request)
    {
        $result = $this->admin_account->addAdminUser($request->all());

        flash('', __('messages.create.success'),'success');

        return redirect()->route('admins');
    }

    public function edit(Request $request, AdminAccount $admin_account)
    {
        if($request->password && $request->user()->id == $admin_account->id)
            $admin_account->password = bcrypt($request->password);

        if(!$admin_account->isUltimateAdminUser())
            $admin_account->admin_type = $request->admin_type;

        $result = $admin_account->update();

        flash('', __('messages.update.success'),'success');

        return redirect()->route('admins');
    }

    public function delete(Request $request)
    {
        if($this->admin_account->isUltimateAdminUser($request['del_id'])) {
            flash('', __('messages.delete.unauthorised'),'danger');
        }else{
            //0 = fail   1 = success
            $result = $this->admin_account->removeAdminUser($request['del_id']);

            if($result)
                flash('', __('messages.delete.success'),'success');
            else
                flash('', __('messages.delete.failure'),'danger');
        }

        return back();
    }
}
