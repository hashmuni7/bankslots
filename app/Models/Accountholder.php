<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Accountholder
 * 
 * @property int $accountholderid
 * @property string $name
 * @property string $phonenumber
 * @property string $nin
 * @property Carbon $dob
 * @property int $placesofworkid
 * @property int $businessnaturecategoryid
 * @property string|null $address
 * @property int|null $dailyturnover
 * @property bool $gender
 * @property string|null $photo
 * @property int $registeredby
 * @property Carbon $dateregistered
 * @property string|null $cardfront
 * @property string|null $cardback
 * @property int $accountholderlevelid
 * @property bool $alreadybanked
 * @property string|null $bankname
 * @property string|null $accountnumber
 * @property string|null $accounttype
 * @property string|null $nextofkinname
 * @property string|null $nextofkinphone
 * @property int|null $alreadybankedbankid
 * 
 * @property Accountholderlevel $accountholderlevel
 * @property Bank|null $bank
 * @property Businessnaturecategory $businessnaturecategory
 * @property Placesofwork $placesofwork
 * @property Collection|Bankaccountsgiven[] $bankaccountsgivens
 * @property Collection|Bankaccountsreserved[] $bankaccountsreserveds
 *
 * @package App\Models
 */
class Accountholder extends Model
{
	protected $table = 'accountholders';
	protected $primaryKey = 'accountholderid';
	public $timestamps = false;

	protected $casts = [
		'placesofworkid' => 'int',
		'businessnaturecategoryid' => 'int',
		'dailyturnover' => 'int',
		'gender' => 'bool',
		'registeredby' => 'int',
		'accountholderlevelid' => 'int',
		'alreadybanked' => 'bool',
		'alreadybankedbankid' => 'int'
	];

	protected $dates = [
		'dob',
		'dateregistered'
	];

	protected $fillable = [
		'name',
		'phonenumber',
		'nin',
		'dob',
		'placesofworkid',
		'businessnaturecategoryid',
		'address',
		'dailyturnover',
		'gender',
		'photo',
		'registeredby',
		'dateregistered',
		'cardfront',
		'cardback',
		'accountholderlevelid',
		'alreadybanked',
		'bankname',
		'accountnumber',
		'accounttype',
		'nextofkinname',
		'nextofkinphone',
		'alreadybankedbankid'
	];

	public function accountholderlevel()
	{
		return $this->belongsTo(Accountholderlevel::class, 'accountholderlevelid');
	}

	public function bank()
	{
		return $this->belongsTo(Bank::class, 'alreadybankedbankid');
	}

	public function businessnaturecategory()
	{
		return $this->belongsTo(Businessnaturecategory::class, 'businessnaturecategoryid');
	}

	public function placesofwork()
	{
		return $this->belongsTo(Placesofwork::class, 'placesofworkid');
	}

	public function bankaccountsgivens()
	{
		return $this->hasMany(Bankaccountsgiven::class, 'accountholderid');
	}

	public function bankaccountsreserveds()
	{
		return $this->hasMany(Bankaccountsreserved::class, 'accountholderid');
	}
}
