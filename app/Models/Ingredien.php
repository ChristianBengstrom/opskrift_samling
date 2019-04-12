<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 09 Apr 2019 08:39:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Nicolaslopezj\Searchable\SearchableTrait;

/**
 * Class Ingredien
 *
 * @property int $id
 * @property string $navn
 * @property string $enhed
 *
 * @property \Illuminate\Database\Eloquent\Collection $relations
 *
 * @package App\Models
 */
class Ingredien extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'navn',
		'enhed'
	];

	// use SearchableTrait;

  //   protected $searchable = [
  //       'columns' => [
  //           'ingrediens.navn' => 10,
  //       ],
  //   ];
	//
	// public function profile()
  //   {
  //       return $this->hasOne(Ingredien::class);
  //   }

	public function relations()
	{
		return $this->hasMany(\App\Models\Relation::class, 'i_id');
	}
}
