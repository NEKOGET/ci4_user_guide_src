<?php

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

$data = [
    [
        'title'  => 'Title 1',
        'author' => 'Author 1',
        'name'   => 'Name 1',
        'date'   => 'Date 1',
    ],
    [
        'title'  => 'Title 2',
        'author' => 'Author 2',
        'name'   => 'Name 2',
        'date'   => 'Date 2',
    ],
];

$builder->updateBatch($data, ['title', 'author']);

// OR
$builder->setData($data)->onConstraint('title, author')->updateBatch();

// OR
$builder->setData($data)
    ->setAlias('u')
    ->onConstraint(['`mytable`.`title`' => '`u`.`title`', 'author' => new RawSql('`u`.`author`')])
    ->updateBatch();

// OR
$builder->setData($data)
    ->setAlias('u')
    ->onConstraint(new RawSql('`mytable`.`title` = `u`.`title` AND `mytable`.`author` = `u`.`author`'))
    ->updateFields(['last_update' => new RawSql('CURRENT_TIMESTAMP()')], true)
    ->updateBatch();
/*
 * Produces:
 * UPDATE `mytable`
 * INNER JOIN (
 * SELECT 'Title 1' `title`, 'Author 1' `author`, 'Name 1' `name`, 'Date 1' `date` UNION ALL
 * SELECT 'Title 2' `title`, 'Author 2' `author`, 'Name 2' `name`, 'Date 2' `date`
 * ) `u`
 * ON `mytable`.`title` = `u`.`title` AND `mytable`.`author` = `u`.`author`
 * SET
 * `mytable`.`title` = `u`.`title`,
 * `mytable`.`name` = `u`.`name`,
 * `mytable`.`date` = `u`.`date`,
 * `mytable`.`last_update` = CURRENT_TIMESTAMP() // this only applies to the last scenario
 */
