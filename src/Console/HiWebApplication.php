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
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;

class HiWebApplication extends Application
{
    /**
     * Initialize the HiWeb console application.
     */
    public function __construct()
    {
        parent::__construct('HiWeb');

        $this->addCommands([
            new ServiceDetailsCommand(),
        ]);
    }

    /**
     * @return InputDefinition
     */
    protected function getDefaultInputDefinition(): InputDefinition
    {
        $definition = parent::getDefaultInputDefinition();

        $definition->addOption(new InputOption(
            'username',
            'u',
            InputOption::VALUE_REQUIRED,
            'The username of the user.'
        ));

        $definition->addOption(new InputOption(
            'password',
            'p',
            InputOption::VALUE_REQUIRED,
            'The password of the user.'
        ));

        return $definition;
    }
}
