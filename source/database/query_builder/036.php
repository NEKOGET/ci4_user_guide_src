<?php

// With closure
$builder->orWhereNotIn('id', function (BaseBuilder $builder) {
    return $builder->select('job_id')->from('users_jobs')->where('user_id', 3);
});
// Produces: OR "id" NOT IN (SELECT "job_id" FROM "users_jobs" WHERE "user_id" = 3)

// With builder directly
$subQuery = $db->table('users_jobs')->select('job_id')->where('user_id', 3);
$builder->orWhereNotIn('id', $subQuery);
