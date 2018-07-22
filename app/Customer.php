<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    public function getCount()
    {
        return $this->count();
    }

    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

    public function getByQuery($query, $pageLimit = 20)
    {
        $one = $this;

        if(isset($query['search_string'])&& $query['search_string']!=''){
            $one = $one->where('name','like','%'.$query['search_string'].'%');
        }

        if(isset($query['order_by'])&& $query['order_by']!='' && isset($query['filter_col'])&& $query['filter_col']!=''){
            $one=$one->orderBy($query['filter_col'],$query['order_by']);
        }else{
            $one=$one->orderBy('id','Desc');
        }

        //下面这行和controller里面的load那行作用是一样的，但是我竟然用了ajax来实现，太愚蠢了
        //$one=$one->with('contacts');

        return $one->paginate($pageLimit);
    }

    public function addCustomer($customer)
    {
        return $this->create(__field($customer));
    }

    public function removeCustomer($id)
    {
        $contact_count = $this->find($id)->contacts()->delete();
        $customer_count = $this->where('id', $id)->delete();
        return $contact_count + $customer_count;
    }

    public function getContacts($id)
    {
        return $this->find($id)->contacts()->get();
    }

}
