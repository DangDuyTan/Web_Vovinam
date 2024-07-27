<?php

declare(strict_types=1);

namespace App\Application\Actions\Judge;

use App\Application\Actions\Action;
use App\Domain\Judge\JudgeRepository;
use Psr\Log\LoggerInterface;

abstract class JudgeAction extends Action
{
    protected JudgeRepository $judgeRepository;

    public function __construct(LoggerInterface $logger, JudgeRepository $judgeRepository)
    {
        parent::__construct($logger);
        $this->judgeRepository = $judgeRepository;
    }
}
