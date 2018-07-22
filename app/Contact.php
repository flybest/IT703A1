<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    public function getCount()
    {
        return $this->count();
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

        //下面这行和controller里面的load那行作用是一样的，用一个就可以了
//        $one=$one->with(['customer', 'title']);

        return $one->paginate($pageLimit);
    }

    public function addContact($contact)
    {
        return $this->create(__field($contact));
    }

    public function removeContact($id)
    {
        return $this->where('id', $id)->delete();
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function title()
    {
        return $this->belongsTo('App\Title');
    }
}
