<?php

/*
 * This file is part of the webmozart/console package.
 *
 * (c) Bernhard Schussek <bschussek@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Webmozart\Console\Tests\Handler;

use PHPUnit_Framework_Assert;
use PHPUnit_Framework_TestCase;
use Webmozart\Console\Api\Args\Args;
use Webmozart\Console\Api\Args\Format\ArgsFormat;
use Webmozart\Console\Api\Command\Command;
use Webmozart\Console\Api\Config\CommandConfig;
use Webmozart\Console\Api\IO\IO;
use Webmozart\Console\Handler\CallableHandler;
use Webmozart\Console\IO\BufferedIO;

/**
 * @since  1.0
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class CallableHandlerTest extends PHPUnit_Framework_TestCase
{
    public function testHandleCommand()
    {
        $args = new Args(new ArgsFormat());
        $io = new BufferedIO("line1\nline2");
        $command = new Command(new CommandConfig('command'));

        $handler = new CallableHandler(
            function (Command $command, Args $passedArgs, IO $io) use ($args) {
                PHPUnit_Framework_Assert::assertSame($args, $passedArgs);

                $io->write($io->readLine());
                $io->error($io->readLine());

                return 123;
            }
        );

        $this->assertSame(123, $handler->handle($command, $args, $io));
        $this->assertSame("line1\n", $io->fetchOutput());
        $this->assertSame("line2", $io->fetchErrors());
    }
}
