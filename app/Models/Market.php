<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Market
 * 
 * @property int $marketid
 * @property string $marketname
 * @property int $districtid
 * @property int|null $vendorpopulation
 * @property string|null $contactname
 * @property string|null $contactphone
 * @property string|null $marketcode
 * 
 * @property District $district
 * @property Collection|Marketvendor[] $marketvendors
 *
 * @package App\Models
 */
class Market extends Model
{
	protected $table = 'markets';
	protected $primaryKey = 'marketid';
	public $timestamps = false;

	protected $casts = [
		'districtid' => 'int',
		'vendorpopulation' => 'int'
	];

	protected $fillable = [
		'marketname',
		'districtid',
		'vendorpopulation',
		'contactname',
		'contactphone',
		'marketcode'
	];

	public function district()
	{
		return $this->belongsTo(District::class, 'districtid');
	}

	public function marketvendors()
	{
		return $this->hasMany(Marketvendor::class, 'marketid');
	}
}
