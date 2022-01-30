<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Businessnature
 * 
 * @property int $businessnatureid
 * @property string $businessnature
 * @property string|null $description
 * 
 * @property Collection|Marketvendor[] $marketvendors
 *
 * @package App\Models
 */
class Businessnature extends Model
{
	protected $table = 'businessnature';
	protected $primaryKey = 'businessnatureid';
	public $timestamps = false;

	protected $fillable = [
		'businessnature',
		'description'
	];

	public function marketvendors()
	{
		return $this->hasMany(Marketvendor::class, 'businessnatureid');
	}
}
