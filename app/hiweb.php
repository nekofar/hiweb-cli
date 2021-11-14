<?php

/*
 * (c) Milad Nekofar <milad@nekofar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use Nekofar\HiWeb\Console\HiWebApplication;

$loader = include __DIR__ . '/../vendor/autoload.php';

if (!$loader) {
    die('You must set up the project dependencies.');
}

return new HiWebApplication();
