<?php

namespace App\Command;

use App\Websocket\MessageHandler;
use App\Websocket\WebsocketServerFactory;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class WebsocketServerCommand
 *
 * @package App\Command
 * @author Jérémy GUERIBA
 */
class WebsocketServerCommand extends Command
{
    private const DEFAULT_PORT = 3001;
    private const PORT_OPTION_LABEL = 'port';

    protected static $defaultName = "run:websocket-server";

    /**
     * Command configuration
     */
    protected function configure(): void
    {
        $this->setDescription("Websocket server");

        $this->addOption(
            self::PORT_OPTION_LABEL,
            self::PORT_OPTION_LABEL[0],
            InputOption::VALUE_OPTIONAL,
            "Port used by websocket server",
            self::DEFAULT_PORT
        );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $port = $input->getOption(self::PORT_OPTION_LABEL);
        $server = WebsocketServerFactory::create($port);

        $output->writeln("Starting server on port " . $port);

        $server->run();

        return Command::SUCCESS;
    }
}