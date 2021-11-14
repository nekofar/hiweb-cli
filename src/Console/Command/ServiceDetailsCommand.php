<?php

/*
 * (c) Milad Nekofar <milad@nekofar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Nekofar\HiWeb\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Panther\Client;

/**
 *
 */
class ServiceDetailsCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'service:details'; // @phpcs:ignore

    /**
     * {@inheritDoc}
     *
     * @return void
     */
    protected function configure(): void
    {
        parent::configure();

        $this->setDescription('Retrieve service details')
            ->setHelp('The <info>details</info> commend retrieve current service detail from HiWeb control panel.');
    }

    /**
     * Retrieve service details
     *
     * @return integer integer 0 on success, or an error code.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $client = Client::createChromeClient();

        $client->request('GET', 'https://panel.hiweb.ir/login');
        $client->submitForm('ورود به پنل', [
            'Username' => $input->getOption('username'),
            'Password' => $input->getOption('password'),
        ]);

        $crawler = $client->waitFor('[id^=serviceDetail]');
        $crawler->selectButton('مشاهده جزئیات')->click();

        $crawler = $client->waitFor('[id^=serviceDetail] > div.text-info');

        $remainTrafficInternet = $crawler->filter(
            '[id^=serviceDetail] > div:nth-child(3) > div.col-xs-7.col-lg-10.col-md-9 > div > label:nth-child(1)',
        )->text();
        $remainTrafficIntranet = $crawler->filter(
            '[id^=serviceDetail] > div:nth-child(3) > div.col-xs-7.col-lg-10.col-md-9 > div > label:nth-child(3)',
        )->text();
        $uploadSpeed = $crawler->filter(
            '[id^=serviceDetail] > div:nth-child(4) > div.col-xs-7.col-lg-10.col-md-9 > label',
        )->text();
        $downloadSpeed = $crawler->filter(
            '[id^=serviceDetail] > div:nth-child(5) > div.col-xs-7.col-lg-10.col-md-9 > label',
        )->text();
        $nextMonthTrafficDate = $crawler->filter(
            '[id^=serviceDetail] > div:nth-child(6) > div.col-xs-7.col-lg-10.col-md-9 > label',
        )->text();
        $nextMonthTrafficVolume = $crawler->filter(
            '[id^=serviceDetail] > div:nth-child(7) > div.col-xs-7.col-lg-10.col-md-9 > label',
        )->text();
        $purchaseDate = $crawler->filter(
            '[id^=serviceDetail] > div:nth-child(8) > div.col-xs-7.col-lg-10.col-md-9 > label',
        )->text();
        $activationDate = $crawler->filter(
            '[id^=serviceDetail] > div:nth-child(9) > div.col-xs-7.col-lg-10.col-md-9 > label',
        )->text();
        $expirationDate = $crawler->filter(
            '[id^=serviceDetail] > div:nth-child(10) > div.col-xs-7.col-lg-10.col-md-9 > label',
        )->text();

        $table = new Table($output);
        $table->addRows(
            [
                ['remainTrafficInternet', $remainTrafficInternet],
                ['remainTrafficIntranet', $remainTrafficIntranet],
                ['uploadSpeed', $uploadSpeed],
                ['downloadSpeed', $downloadSpeed],
                ['nextMonthTrafficDate', $nextMonthTrafficDate],
                ['nextMonthTrafficVolume', $nextMonthTrafficVolume],
                ['purchaseDate', $purchaseDate],
                ['activationDate', $activationDate],
                ['expirationDate', $expirationDate],
            ],
        );
        $table->render();

        return Command::SUCCESS;
    }
}
