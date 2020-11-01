<?php


namespace App\Repository;


use App\Models\History;

class HistoryRepository
{
    private $model;

    /**
     * ProductRepository constructor.
     * @param  History  $model
     */
    public function __construct(History $model)
    {
        $this->model = $model;
    }

    /**
     * Get all products
     * @return History[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model::all();
    }

    /**
     * Create Many histories
     * @param  array  $histories
     * @return History[]|array
     */
    public function createHistories(array $histories)
    {
        $createdHistories = [];
        foreach ($histories as $index => $history) {
            $history['previous_balance'] = 0;
            $history['final_balance'] = 0;
            $history['price'] = 0;
            $createdHistories[] = $this->model::create($history);
        }
        return $createdHistories;
    }
}
