<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class District
 * 
 * @property int $districtid
 * @property string $district
 * 
 * @property Collection|Market[] $markets
 * @property Collection|Placesofwork[] $placesofworks
 *
 * @package App\Models
 */
class District extends Model
{
	protected $table = 'districts';
	protected $primaryKey = 'districtid';
	public $timestamps = false;

	protected $fillable = [
		'district'
	];

	public function markets()
	{
		return $this->hasMany(Market::class, 'districtid');
	}

	public function placesofworks()
	{
		return $this->hasMany(Placesofwork::class, 'districtid');
	}
}
