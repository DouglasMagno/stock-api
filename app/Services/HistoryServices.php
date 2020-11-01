<?php


namespace App\Services;


use App\Repository\HistoryRepository;

class HistoryServices
{
    private $repository;
    public function __construct(HistoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get All histories
     * @return \App\Models\History[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function createHistories(array $histories)
    {
        return $this->repository->createHistories($histories);
    }
}
