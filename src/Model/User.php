<?php

declare(strict_types = 1);

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model {
	use SoftDeletes;

	protected $table      = 'user';
	protected $primaryKey = 'user_id';
	protected $dates      = ['created_at', 'updated_at', 'deleted_at'];

	/**
	 * @return HasMany
	 */
	public function authenticationTokens(): HasMany {
	    return $this->hasMany(AuthenticationToken::class, 'user_id');
	}
}
