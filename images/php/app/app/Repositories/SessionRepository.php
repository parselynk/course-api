<?php

namespace App\Repositories;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\SessionsInterface;

class SessionRepository implements SessionsInterface
{
    public function getProgressHistory(int $userId = null): array
    {
        $this->validateUserId($userId);

        $query = "(select se.id, se.created_at as date, sc.score from sessions as se join scores as sc on se.id = sc.session_id where se.user_id = :user_id  ORDER BY date desc limit 12 ) order by date asc";

        if ($results = DB::select(DB::raw($query), ['user_id' => $userId])) {
            return ['history' => $results];
        }
         return [];
    }

    public function getLastSessionCategories(int $userId = null): array
    {

        $this->validateUserId($userId);

        $query = "select se.id as session_id, c.name from sessions as se join exercise_session as es on se.id = es.session_id join exercises as e on es.exercise_id = e.id join categories as c on e.category_id = c.id where session_id = ( select id from sessions where user_id = :user_id order by created_at desc limit 1 ) group by c.name, se.id";

        if ($results = DB::select(DB::raw($query), ['user_id' => $userId])) {
            return ['session_id' => $results[0]->session_id , 'categories' => Arr::pluck($results, 'name') ];
        }
        return [];
    }

    protected function validateUserId($userId)
    {
        if (empty($userId)) {
            throw new \InvalidArgumentException('user id is missing.');
        }
    }
}
