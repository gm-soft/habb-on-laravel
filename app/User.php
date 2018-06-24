<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Symfony\Component\Console\Exception\InvalidArgumentException;

/**
 * Class User
 * @property integer role
 * @property int id
 * @property mixed name
 * @property string email
 * @property string password
 * @property string gamer_id
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /** @var \Validator $validator*/
    private $validator = null;

    public static $rules = array(
        'name'                  => 'required|between:3,80',
        'email'                 => 'required|between:5,255|email|unique:users',
        'password'              => 'required|min:6|confirmed',
        'password_confirmation' => 'required|min:6',
    );

    public function GetRules($withoutPassword = false)
    {
        $array = [
            'name'                  => 'required|between:3,80',
            'email'                 => 'required|between:5,255|email|unique:users,email,'.$this->id,
        ];
        if (!$withoutPassword) {
            $array['password'] = 'required|min:6|confirmed';
            $array['password_confirmation'] = 'required|min:6';
        }
        return $array;
    }

    protected $fillable = [
        'name', 'email', 'password',
    ];

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

    public function getRoleAsString() {
        switch ($this->role){
            case 0: return "Демонстрация";
            case 1: return "Пользователь";
            case 2: return "Администратор";
            case 3: return "Девелопер";

            default: return "Не определен";
        }
    }

    /**
     * Возвращает ссылку на аккаунт игрока. Если нет такого, то будет null
     * @return null|string
     */
    public function getGamerAccountUrl(){
        if (is_null($this->gamer_id)){
            return null;
        }
        return action('GamerController@show', ['id' => $this->gamer_id]);
    }

    protected function statusCheck ($role = 0)
    {
        return $this->role === $role ? true : false;
    }

    public function getName() {
        return $this->name;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne | \App\Models\Gamer | null
     */
    public function gamer(){
        if (is_null($this->gamer_id)){
            return null;
        }
        return $this->hasOne('App\Gamer');
    }

    /**
     * @param array $input
     * @param bool $withoutPassword
     * @return bool
     */
    public function Validate(array $input, $withoutPassword = false){
        $this->validator = \Validator::make($input, $this->GetRules($withoutPassword));
        return $this->validator->passes();
    }

    /**
     * @return array
     */
    public function GetValidateErrors(){
        if (is_null($this->validator)){
            throw new InvalidArgumentException("не инициирован валидатор");
        }
        return $this->validator->errors();
    }
}
