<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Model
{
    use HasApiTokens, HasRoles;

    protected $fillable = ['name','email','mobile','password'];

    protected $dates = [];

    // Relationships
    public function findForPassport($login)
    {
        return $this->where('email', $login)->first();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthIdentifierName()
    {
        return $this->getKeyName();
    }

    public function franchiser()
    {
        return $this->hasOne('App\Franchiser');
    }
}