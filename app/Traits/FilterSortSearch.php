<?php

namespace App\Traits;

trait FilterSortSearch
{
    public function applyFilterSortSearch($col_array, $query, $request)
    {
        if ($search = $request->getSearch()) {
            $query->searchByCol($col_array, $search);
        }


        if ($sort = $request->getSort()) {
            $query->sortByColumn($sort, $request->getDirection());
        }

        if (!is_null($filters = $request->getFilter())) {
            foreach ($filters as $key => $value) {
                $query->where($key, $value);
            }
        }

        return $query;
    }
}
