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
 * Class Company
 * 
 * @property int $id
 * @property int $plan_id
 * @property int|null $segment_id
 * @property int|null $state_id
 * @property int|null $city_id
 * @property string $name
 * @property string|null $corporate_name
 * @property string|null $cnpj
 * @property string|null $logo
 * @property string|null $cep
 * @property string|null $neighborhood
 * @property string|null $address
 * @property string|null $number
 * @property string|null $complement
 * @property Carbon $final_date
 * @property Carbon $initial_date
 * @property string $status
 * @property string|null $corporate_email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property City|null $city
 * @property Plan $plan
 * @property Segment|null $segment
 * @property State|null $state
 * @property Collection|Coupon[] $coupons
 * @property Collection|Customer[] $customers
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Company extends Model
{
	use SoftDeletes;
    const STATUS = ['active'=>'Ativo', 'inactive'=>'Inativo'];

	protected $table = 'companies';

	protected $casts = [
		'plan_id' => 'int',
		'segment_id' => 'int',
		'state_id' => 'int',
		'city_id' => 'int',
		'final_date' => 'datetime',
		'initial_date' => 'datetime'
	];

	protected $fillable = [
		'plan_id',
		'segment_id',
		'state_id',
		'city_id',
		'name',
		'corporate_name',
		'cnpj',
		'logo',
		'cep',
		'neighborhood',
		'address',
		'number',
		'complement',
		'final_date',
		'initial_date',
		'status',
		'corporate_email'
	];

	public function promotions()
	{
		return $this->hasMany(Promotion::class);
	}
	public function city()
	{
		return $this->belongsTo(City::class);
	}

	public function plan()
	{
		return $this->belongsTo(Plan::class);
	}

	public function segment()
	{
		return $this->belongsTo(Segment::class);
	}

	public function state()
	{
		return $this->belongsTo(State::class);
	}

	public function coupons()
	{
		return $this->hasMany(Coupon::class);
	}

	public function customers()
	{
		return $this->belongsToMany(Customer::class, 'customer_company')
			->withPivot('id')
			->withTimestamps();
	}

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
