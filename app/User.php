<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @property integer role
 * @property int id
 * @property mixed name
 * @property string email
 * @property string password
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

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
    protected $dates = ['deleted_at'];

    /**
     * Определяет, может ли пользователь просматривать бэкенд
     * @return bool
     */
    public function hasBackendRight(){
        return $this->isAdmin() || $this->isDeveloper();
    }

    public function isDisabled ()
    {
        return $this->statusCheck();
    }

    public function isVisitor ()
    {
        return $this->statusCheck(1);
    }

    public function isAdmin ()
    {
        return $this->statusCheck(2);
    }

    public function isDeveloper ()
    {
        return $this->statusCheck(3);
    }

    protected function statusCheck ($role = 0)
    {
        return $this->role === $role ? true : false;
    }

    public function getName() {
        return $this->name;
    }
}
