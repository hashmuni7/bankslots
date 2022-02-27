<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bank
 * 
 * @property int $bankid
 * @property string $bank
 * @property string $bankcode
 * @property string $address
 * @property string $contact
 * @property string $email
 * 
 * @property Collection|Accountholder[] $accountholders
 * @property Collection|Bankaccountsreserved[] $bankaccountsreserveds
 * @property Collection|Bankbranch[] $bankbranches
 *
 * @package App\Models
 */
class Bank extends Model
{
	protected $table = 'banks';
	protected $primaryKey = 'bankid';
	public $timestamps = false;

	protected $fillable = [
		'bank',
		'bankcode',
		'address',
		'contact',
		'email'
	];

	public function accountholders()
	{
		return $this->hasMany(Accountholder::class, 'alreadybankedbankid');
	}

	public function bankaccountsreserveds()
	{
		return $this->hasMany(Bankaccountsreserved::class, 'bankid');
	}

	public function bankbranches()
	{
		return $this->hasMany(Bankbranch::class, 'bankid');
	}
}
