<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Marketvendor
 * 
 * @property int $marketvendorid
 * @property string $name
 * @property string|null $phonenumber
 * @property string|null $nin
 * @property string|null $businessplace
 * @property int $businessnatureid
 * @property string|null $residenceplace
 * @property int|null $dailyturnover
 * @property bool $gender
 * @property string|null $photo
 * @property string|null $accountnumber
 * @property int|null $registeredby
 * @property Carbon|null $dateregistered
 * @property int|null $marketid
 * 
 * @property Businessnature $businessnature
 * @property User|null $user
 * @property Market|null $market
 *
 * @package App\Models
 */
class Marketvendor extends Model
{
	protected $table = 'marketvendors';
	protected $primaryKey = 'marketvendorid';
	public $timestamps = false;

	protected $casts = [
		'businessnatureid' => 'int',
		'dailyturnover' => 'int',
		'gender' => 'bool',
		'registeredby' => 'int',
		'marketid' => 'int'
	];

	protected $dates = [
		'dateregistered'
	];

	protected $fillable = [
		'name',
		'phonenumber',
		'nin',
		'businessplace',
		'businessnatureid',
		'residenceplace',
		'dailyturnover',
		'gender',
		'photo',
		'accountnumber',
		'registeredby',
		'dateregistered',
		'marketid'
	];

	public function businessnature()
	{
		return $this->belongsTo(Businessnature::class, 'businessnatureid');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'registeredby');
	}

	public function market()
	{
		return $this->belongsTo(Market::class, 'marketid');
	}
}
