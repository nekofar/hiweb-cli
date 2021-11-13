<?php

/*
 * (c) Milad Nekofar <milad@nekofar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Nekofar\HiWeb\Console;

use Nekofar\HiWeb\Console\Command\ServiceDetailsCommand;
use Symfony\Component\Console\Application;

class HiWebApplication extends Application
{
    /**
     * Initialize the HiWeb console application.
     */
    public function __construct()
    {
        parent::__construct('HiWeb');

        $this->addCommands([
        ]);
    }
}
