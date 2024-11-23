<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class City
 * 
 * @property int $id
 * @property int $state_id
 * @property string $title
 * @property string $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property State $state
 * @property Collection|Company[] $companies
 * @property Collection|Customer[] $customers
 *
 * @package App\Models
 */
class City extends Model
{
	use SoftDeletes;
	protected $table = 'cities';

	protected $casts = [
		'state_id' => 'int'
	];

	protected $fillable = [
		'state_id',
		'title',
		'slug'
	];

	public function state()
	{
		return $this->belongsTo(State::class);
	}

	public function companies()
	{
		return $this->hasMany(Company::class);
	}

	public function customers()
	{
		return $this->hasMany(Customer::class);
	}
}
