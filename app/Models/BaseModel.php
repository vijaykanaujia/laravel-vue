<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasFactory;

    protected $relations = [];
    protected $textSearch = [];
    /**
     * @var Illuminate\Database\Eloquent\Builder | null
     */
    protected $queryBuilder = null;

    protected $perPage = 20;

    public function getAllColumns()
    {
        return [];
    }

    public function searchableColumns()
    {
        return [];
    }

    public function getDefaultColumns()
    {
        return [];
    }

    public function selectCols($cols)
    {
        $bulder = $this->queryBuilder ?? $this;
        $allCols = $this->getAllColumns();
        $tmp = array_keys($allCols);
        if (!empty($cols) && is_array($cols)) {
            $validCols = $this->getValidValues($cols, $tmp);
            $bulder = $bulder->select(...$validCols);
        } else {
            $bulder = $bulder->select(...$this->getDefaultColumns());
        }
        $this->queryBuilder = $bulder;
        return $this;
    }

    public function applyFilter($filter)
    {
        $decodedData = json_decode($filter, 1);
        if (!empty($decodedData) && is_array($decodedData)) {
            $decodedData = collect($decodedData);

            $bulder = $this->queryBuilder ?? $this;
            if (!empty($decodedData['all'])) {
                $bulder = $bulder->where(function ($q) use ($decodedData) {
                    $fuzzySearchCols = implode('`,`', $this->searchableColumns());
                    $fuzzySearch = implode("%", explode(" ", $decodedData['all']));
                    $q = $q->where(DB::raw("CONCAT_WS('',`$fuzzySearchCols`)"), 'like', "%{$fuzzySearch}%");
                    return $q;
                });
                unset($decodedData['all']);
            }
            $allCols = $this->getAllColumns();
            foreach ($decodedData as $key => $value) {
                if ((!empty($value) || $value === 0 || $value === "0") && isset($allCols[$key])) {
                    if ($allCols[$key] == 'text') {
                        $bulder = $bulder->where($key, 'like', strlen($value) > 3 ? "%$value%" : "$value%");
                    } else {
                        $bulder = $bulder->where($key, $value);
                    }
                }
            }

            $this->queryBuilder = $bulder;
        }
        return $this;
    }

    public function sortOrder($col, $order)
    {
        $bulder = $this->queryBuilder ?? $this;
        if (!in_array($col, array_keys($this->getAllColumns())))
            $col = 'id';

        if (!in_array($order, ['asc', 'desc']))
            $order = 'desc';
        $bulder = $bulder->orderBy($col, $order);
        $this->queryBuilder = $bulder;
        return $this;
    }

    protected function getValidValues($values, $validValues)
    {
        return collect($validValues)->filter(function ($v) use ($values) {
            return in_array($v, $values);
        })->toArray();
    }

    public function getWith($with)
    {
        return is_array($with) ? collect($with)->filter(function ($v) {
            $temp1 = explode('.', $v);
            $temp2 = explode(':', $temp1[0]);
            return in_array($temp2[0], $this->relations);
        })->toArray() : [];
    }

    public function handleWith($with)
    {
        $bulder = $this->queryBuilder ?? $this;
        $bulder = $bulder->with($this->getWith($with));
        $this->queryBuilder = $bulder;
        return $this;
    }

    public function getBuilder()
    {
        return $this->queryBuilder ?? $this;
    }

    public function fullTextWildcards($term)
    {
        // removing symbols used by MySQL
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);

        $words = explode(' ', $term);

        foreach ($words as $key => $word) {
            /*
             * applying + operator (required word) only big words
             * because smaller ones are not indexed by mysql
             */
            $word = trim($word);
            if (strlen($word) >= 3) {
                $words[$key] = "$word*";
            }
        }

        $searchTerm = implode(' ', $words);

        return $searchTerm;
    }
}
