<?php

namespace App\Helpers;

use Illuminate\Database\Events\QueryExecuted;

/**
 * Класс для просоморта SQL запросов.
 * Можно увидеть общее время всех запросов, кол-во запросов,
 * в какие базы сколько запросов уходит.
 *
 * Для использования вызываем метод startLogging()
 * После действий с базой вызываем метод getQueries.
 *
 * После того как подебажили, выпиливаем класс из кода.
 */
class DatabaseQueryLog
{
    /**
     * @var array
     */
    protected static $queries = [];

    /**
     * Начинаем логирование
     */
    public static function startLogging()
    {
        \DB::listen(function ($query) {
            /** @var $query QueryExecuted */
            self::$queries['queries'][] = [
                'query' => $query->sql,
                'bindings' => $query->bindings,
                'time' => $query->time,
                'connection' => $query->connectionName
            ];
        });
    }

    /**
     * Получаем статистику
     *
     * @return array
     */
    public static function getQueries(): array
    {
        self::$queries['summary_time'] = self::getSummaryTime();
        self::$queries['count_queries_by_connection'] = self::getCountForConnections();
        self::$queries['total_queries'] = isset(self::$queries['queries']) ? count(self::$queries['queries']) : 0;
        return self::$queries;
    }

    /**
     * @return float
     */
    protected static function getSummaryTime(): float
    {
        $time = 0;

        if (!isset(self::$queries['queries']) || empty(self::$queries['queries'])) {
            return $time;
        }

        foreach (self::$queries['queries'] as $query) {
            $time += $query['time'];
        }

        return $time;
    }

    /**
     * @return array
     */
    protected static function getCountForConnections(): array
    {
        $count = [];

        if (!isset(self::$queries['queries']) || empty(self::$queries['queries'])) {
            return $count;
        }

        foreach (self::$queries['queries'] as $query) {
            array_key_exists($query['connection'], $count) ? $count[$query['connection']]++ : $count[$query['connection']] = 1;
        }

        return $count;
    }
}
