<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    public function hasAccess(array $permissions) : bool
    {
        // check if the permission is available in any role
        foreach ($this->roles as $role) {
            if($role->hasAccess($permissions)) {
                return true;
            }
        }
        return false;
    }
    public function inRole(string $roleSlug)
    {
        return $this->roles()->where('slug', $roleSlug)->count() == 1;
    }


    function userdetail()
    {
        return $this->hasOne(UserDetail::class);

    }

    function clientdetail()
    {
        return $this->hasOne(ClientDetail::class);

    }


    public function orders()
    {
        return $this->hasMany(Order::class,'customer_id');

    }


// relation with order table as an employee role

    public function employee_orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('amount')->withTimestamps();

    }




    // relation with faq table
    public function faqs()
    {
        return $this->hasMany(faq::class);
    }

// relation with messages table
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
