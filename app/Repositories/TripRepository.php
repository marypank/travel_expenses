<?php

namespace App\Repositories;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Collection;

class TripRepository extends BaseRepository
{
    // todo: try Trip::class
    public function model()
    {
        return new Trip();
    }

    public function findBySlug(string $slug): ?Trip
    {
        return $this->model()::where('slug', $slug)->first();
    }

    public function all(int $id): Collection
    {
        return $this->model()
            ->where('user_id', $id)
            ->orderBy('date_from')
            ->get();
    }
    
    public function search($data): Collection
    {
        return new Collection();
    }

    // todo: попробовать реализовать конструктор типа такого. подумать как можно не реализовать передачу инициализированного объекта
    /* public function byStatus(Trip $trip, int $status)
    {
        return $trip->where('status', $status);
    } */
}