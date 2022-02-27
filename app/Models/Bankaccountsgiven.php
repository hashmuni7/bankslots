<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Bankaccountsgiven
 * 
 * @property int $bankaccountgivenid
 * @property int $accountholderid
 * @property bool $newaccount
 * @property int $bankbranchid
 * @property int $bankaccountsreservedid
 * 
 * @property Accountholder $accountholder
 * @property Bankaccountsreserved $bankaccountsreserved
 * @property Bankbranch $bankbranch
 *
 * @package App\Models
 */
class Bankaccountsgiven extends Model
{
	protected $table = 'bankaccountsgiven';
	protected $primaryKey = 'bankaccountgivenid';
	public $timestamps = false;

	protected $casts = [
		'accountholderid' => 'int',
		'newaccount' => 'bool',
		'bankbranchid' => 'int',
		'bankaccountsreservedid' => 'int'
	];

	protected $fillable = [
		'accountholderid',
		'newaccount',
		'bankbranchid',
		'bankaccountsreservedid'
	];

	public function accountholder()
	{
		return $this->belongsTo(Accountholder::class, 'accountholderid');
	}

	public function bankaccountsreserved()
	{
		return $this->belongsTo(Bankaccountsreserved::class, 'bankaccountsreservedid');
	}

	public function bankbranch()
	{
		return $this->belongsTo(Bankbranch::class, 'bankbranchid');
	}
}
