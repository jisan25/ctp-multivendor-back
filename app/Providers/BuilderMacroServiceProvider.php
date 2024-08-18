<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class BuilderMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Search by name macro
        Builder::macro('searchByCol', function ($col_array, $search) {
            return $this->where(function ($query) use ($col_array, $search) {
                foreach ($col_array as $col) {
                    $query->orWhere($col, 'like', '%' . $search . '%');
                }
            });
        });


        // Sort by a given column and direction
        Builder::macro('sortByColumn', function ($column, $direction = 'asc') {
            return $this->orderBy($column, $direction);
        });
    }
}
