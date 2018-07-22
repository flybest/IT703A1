<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminAccount;
use App\Contact;
use App\Customer;

class DashboardController extends Controller
{

    private $users;
    private $customers;
    private $contacts;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->users = new AdminAccount();
        $this->customers = new Customer();
        $this->contacts = new Contact();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminCount = $this->users->getCount();
        $customerCount = $this->customers->getCount();
        $contactCount = $this->contacts->getCount();

        $count=['admin'=>$adminCount,'customer'=>$customerCount,'contact'=>$contactCount];

        return view('admin.dashboard', compact('count'));
    }
}
