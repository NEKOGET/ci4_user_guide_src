<?php

//With closure
$builder->havingNotIn('id', function (BaseBuilder $builder) {
    return $builder->select('user_id')->from('users_jobs')->where('group_id', 3);
});

// Produces: HAVING "id" NOT IN (SELECT "user_id" FROM "users_jobs" WHERE "group_id" = 3)

// With builder directly
$subQuery = $db->table('users_jobs')->select('user_id')->where('group_id', 3);
$builder->havingNotIn('id', $subQuery);
