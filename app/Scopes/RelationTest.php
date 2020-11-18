<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class RelationTest implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->with(['details', 'user', 'company', 'type'])
                ->withCount(['winners', 'comments', 'rates as rate_user_count']);
    }
}
