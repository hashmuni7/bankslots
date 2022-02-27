<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bankaccountsreserved
 * 
 * @property int $bankaccountsreservedid
 * @property string $accountnumber
 * @property int $bankid
 * @property bool $status
 * @property int $accountholderid
 * 
 * @property Bank $bank
 * @property Accountholder $accountholder
 * @property Collection|Bankaccountsgiven[] $bankaccountsgivens
 *
 * @package App\Models
 */
class Bankaccountsreserved extends Model
{
	protected $table = 'bankaccountsreserved';
	protected $primaryKey = 'bankaccountsreservedid';
	public $timestamps = false;

	protected $casts = [
		'bankid' => 'int',
		'status' => 'bool',
		'accountholderid' => 'int'
	];

	protected $fillable = [
		'accountnumber',
		'bankid',
		'status',
		'accountholderid'
	];

	public function bank()
	{
		return $this->belongsTo(Bank::class, 'bankid');
	}

	public function accountholder()
	{
		return $this->belongsTo(Accountholder::class, 'accountholderid');
	}

	public function bankaccountsgivens()
	{
		return $this->hasMany(Bankaccountsgiven::class, 'bankaccountsreservedid');
	}
}
