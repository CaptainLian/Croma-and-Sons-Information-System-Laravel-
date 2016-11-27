<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use DB;

class Account extends Authenticatable{

	use Notifiable;

	protected $table = 'Accounts';
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Username',
        'Email',
        'Password',
        'PositionID',
        'Firstname',
        'Middlename',
        'Lastname',
        'Landline',
        'MobileNumber',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getAccountWithUsername($username){
    	$result = DB::table('Accounts')
    				->where('Username', '=', $username)
    				->first();
    	return $result;
    }

	public static function dbEncrypt($string){
		return DB::select('select SHA2(?, 512) AS \'encrypt\' ', [$string])[0]->encrypt;
	}
}
