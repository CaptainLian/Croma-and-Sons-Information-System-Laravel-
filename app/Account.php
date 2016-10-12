<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model{
    


	public function getAccountPassword($username){
		$result = DB::select('SELECT Password 
					 		    FROM Accounts 
					 		   WHERE Username = ?', $username);
		return $result->Password;
	}

	public function dbEncrypt($string){
		return DB::select('SELECT password(?) AS encrypt', $string)->encrypt;
	}
}
