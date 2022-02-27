<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Placesofworkcategory
 * 
 * @property int $placesofworkcategoryid
 * @property string $placecategory
 * 
 * @property Collection|Businessnaturecategory[] $businessnaturecategories
 * @property Collection|Placesofwork[] $placesofworks
 *
 * @package App\Models
 */
class Placesofworkcategory extends Model
{
	protected $table = 'placesofworkcategory';
	protected $primaryKey = 'placesofworkcategoryid';
	public $timestamps = false;

	protected $fillable = [
		'placecategory'
	];

	public function businessnaturecategories()
	{
		return $this->hasMany(Businessnaturecategory::class, 'placesofworkcategoryid');
	}

	public function placesofworks()
	{
		return $this->hasMany(Placesofwork::class, 'placesofworkcategoryid');
	}
}
