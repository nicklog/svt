<?php

declare(strict_types=1);

namespace App\Infrastructure\Clock;

use Lcobucci\Clock\SystemClock;
use StellaMaris\Clock\ClockInterface;

final class ClockFactory
{
    public function __invoke(): ClockInterface
    {
        return SystemClock::fromUTC();
    }
}
