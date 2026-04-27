<?php
if (!function_exists('make_query_sql')) {
    function make_query_sql($builder)
    {
        if ($builder instanceof \Illuminate\Database\Events\QueryExecuted) {
            $sql = $builder->sql;
            foreach ($builder->bindings as $binding) {
                $value = is_numeric($binding) ? $binding : "'" . $binding . "'";
                $sql = preg_replace('/\?/', $value, $sql, 1);
            }
        } else {
            $sql = $builder->toSql();
            foreach ($builder->getBindings() as $binding) {
                $value = is_numeric($binding) ? $binding : "'" . $binding . "'";
                $sql = preg_replace('/\?/', $value, $sql, 1);
            }
        }
        return $sql;
    }
}
