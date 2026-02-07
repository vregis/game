<?php

namespace common\models;

class City extends generated\City
{
    /**
     * Связь с играми через промежуточную таблицу
     */
    public function getGames()
    {
        return $this->hasMany(Games::class, ['id' => 'game_id'])
            ->viaTable('{{%city_games}}', ['city_id' => 'id']);
    }

    /**
     * Получить все игры с сортировкой (опционально)
     */
    public function getGamesSorted()
    {
        return $this->hasMany(Games::class, ['id' => 'game_id'])
            ->viaTable('{{%city_games}}', ['city_id' => 'id'])
            ->orderBy(['name' => SORT_ASC]);
    }
}