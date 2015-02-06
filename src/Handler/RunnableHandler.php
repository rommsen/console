<?php

/*
 * This file is part of the webmozart/console package.
 *
 * (c) Bernhard Schussek <bschussek@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Webmozart\Console\Handler;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Webmozart\Console\Api\Command\Command;
use Webmozart\Console\Api\Handler\CommandHandler;
use Webmozart\Console\Api\Runnable;

/**
 * Delegates command handling to a {@link Runnable} object.
 *
 * @since  1.0
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class RunnableHandler extends AbstractHandler
{
    /**
     * @var Runnable
     */
    private $runnable;

    /**
     * Creates the command handler.
     *
     * @param Runnable $runnable The object to run when handling a command.
     */
    public function __construct(Runnable $runnable)
    {
        $this->runnable = $runnable;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(InputInterface $input)
    {
        return $this->runnable->run($input, $this->output, $this->errorOutput);
    }
}