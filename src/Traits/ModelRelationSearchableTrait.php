<?php

namespace HassamUlHaq\LaravelModelRelationSearch\Traits;

use Exception;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait ModelRelationSearchableTrait
{
    /**
     * @throws Exception
     */
    public function scopeSearch(Builder $builder, string $term = ''): Builder
    {
        /**
         * Define $searchable_columns array in specific model
         *
         * protected $searchable_columns = ['title', 'author.bio', 'author.companies.name'];
         */
        if (!$this->searchable_columns)
            throw new Exception("Searchable array property is missing in your model. ");

        foreach ($this->searchable_columns as $searchableColumn) {
            if (str_contains($searchableColumn, '.')) {
                $relation = Str::beforeLast($searchableColumn, '.');
                $column = Str::afterLast($searchableColumn, '.');

                $builder->orWhereRelation($relation, $column, 'like', "%{$term}%");

                continue;
            }
            $builder->orWhere($searchableColumn, 'like', "%{$term}%");
        }

        return $builder;
    }
}
