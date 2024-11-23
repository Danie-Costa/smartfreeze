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
 * Class State
 * 
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Collection|City[] $cities
 * @property Collection|Company[] $companies
 * @property Collection|Customer[] $customers
 *
 * @package App\Models
 */
class State extends Model
{
	use SoftDeletes;
	protected $table = 'states';

	protected $fillable = [
		'title',
		'slug'
	];

	public function cities()
	{
		return $this->hasMany(City::class);
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
