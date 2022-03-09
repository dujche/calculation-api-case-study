<?php

declare(strict_types=1);

namespace App\Tests;

use DG\BypassFinals;
use PHPUnit\Runner\BeforeTestHook;

class ByPassFinalHook implements BeforeTestHook
{
    /**
     * @inheritDoc
     */
    public function executeBeforeTest(string $test): void
    {
        // mutate final classes into non final on-the-fly
        BypassFinals::enable();
    }
}
