<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminAccount extends Authenticatable
{

    use Notifiable;

    protected $fillable = [
        'user_name', 'admin_type', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps = false;

    public function getCount()
    {
        return $this->count();
    }

    public function isSuperAdmin()
    {
        return $this->admin_type == 'super';
    }

    public function getByQuery($query, $pageLimit = 20)
    {
        $one = $this;

        if(isset($query['search_string'])&& $query['search_string']!=''){
            $one = $one->where('user_name','like','%'.$query['search_string'].'%');
        }

        if(isset($query['order_by'])&& $query['order_by']!='' && isset($query['filter_col'])&& $query['filter_col']!=''){
            $one=$one->orderBy($query['filter_col'],$query['order_by']);
        }else{
            $one=$one->orderBy('id','Desc');
        }

        return $one->paginate($pageLimit);
    }

    public function addAdminUser($user)
    {
        $user['password']=bcrypt($user['password']);
        return $this->create(__field($user));
    }

    public function updateAdminUser($user)
    {

    }

    public function removeAdminUser($id)
    {
        return $this->where('id', $id)->delete();
    }

    public function isUltimateAdminUser($id = null)
    {
        if($id==null)
            return $this->user_name == 'admin';
        else
            return ($this->where('id', $id)->first()->user_name == 'admin');
    }
}
