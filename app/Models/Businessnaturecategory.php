<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Businessnaturecategory
 * 
 * @property int $businessnaturecategoryid
 * @property int $placesofworkcategoryid
 * @property string $category
 * @property string $description
 * 
 * @property Placesofworkcategory $placesofworkcategory
 * @property Collection|Accountholder[] $accountholders
 *
 * @package App\Models
 */
class Businessnaturecategory extends Model
{
	protected $table = 'businessnaturecategory';
	protected $primaryKey = 'businessnaturecategoryid';
	public $timestamps = false;

	protected $casts = [
		'placesofworkcategoryid' => 'int'
	];

	protected $fillable = [
		'placesofworkcategoryid',
		'category',
		'description'
	];

	public function placesofworkcategory()
	{
		return $this->belongsTo(Placesofworkcategory::class, 'placesofworkcategoryid');
	}

	public function accountholders()
	{
		return $this->hasMany(Accountholder::class, 'businessnaturecategoryid');
	}
}
