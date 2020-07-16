<?php declare(strict_types=1);

namespace App;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class BookmarkIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    protected $name = 'bookmark_index';

    /**
     * @var array
     */
    protected $settings = [
        //
    ];
}
