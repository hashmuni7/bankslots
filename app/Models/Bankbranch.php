<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bankbranch
 * 
 * @property int $bankbranchid
 * @property string $bankbranch
 * @property string $address
 * @property string $branchcode
 * @property int $bankid
 * 
 * @property Bank $bank
 * @property Collection|Bankaccountsgiven[] $bankaccountsgivens
 *
 * @package App\Models
 */
class Bankbranch extends Model
{
	protected $table = 'bankbranches';
	protected $primaryKey = 'bankbranchid';
	public $timestamps = false;

	protected $casts = [
		'bankid' => 'int'
	];

	protected $fillable = [
		'bankbranch',
		'address',
		'branchcode',
		'bankid'
	];

	public function bank()
	{
		return $this->belongsTo(Bank::class, 'bankid');
	}

	public function bankaccountsgivens()
	{
		return $this->hasMany(Bankaccountsgiven::class, 'bankbranchid');
	}
}
