<?php

/*
 * (c) Milad Nekofar <milad@nekofar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Nekofar\HiWeb\Console\HiWebApplication;

if (!$loader = include __DIR__.'/../vendor/autoload.php') {
    die('You must set up the project dependencies.');
}

return new HiWebApplication();
