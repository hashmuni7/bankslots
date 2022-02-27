<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Placesofwork
 * 
 * @property int $placesofworkid
 * @property string $placeofwork
 * @property int $districtid
 * @property int $prospectivepopulation
 * @property string $contactname
 * @property string $contactphone
 * @property string|null $placecode
 * @property string|null $address
 * @property int $placesofworkcategoryid
 * 
 * @property District $district
 * @property Placesofworkcategory $placesofworkcategory
 * @property Collection|Accountholder[] $accountholders
 *
 * @package App\Models
 */
class Placesofwork extends Model
{
	protected $table = 'placesofwork';
	protected $primaryKey = 'placesofworkid';
	public $timestamps = false;

	protected $casts = [
		'districtid' => 'int',
		'prospectivepopulation' => 'int',
		'placesofworkcategoryid' => 'int'
	];

	protected $fillable = [
		'placeofwork',
		'districtid',
		'prospectivepopulation',
		'contactname',
		'contactphone',
		'placecode',
		'address',
		'placesofworkcategoryid'
	];

	public function district()
	{
		return $this->belongsTo(District::class, 'districtid');
	}

	public function placesofworkcategory()
	{
		return $this->belongsTo(Placesofworkcategory::class, 'placesofworkcategoryid');
	}

	public function accountholders()
	{
		return $this->hasMany(Accountholder::class, 'placesofworkid');
	}
}
