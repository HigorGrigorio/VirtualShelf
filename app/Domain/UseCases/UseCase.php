<?php

namespace App\Domain\UseCases;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Result;
use App\Http\Database\Contracts\IRepository;

abstract class UseCase implements IUseCase
{
    private array $args = [];

    public function __construct(private readonly IRepository $repository)
    {
    }

    abstract public function execute(): Result;

    public function setArgs(array $args): self
    {
        $this->args = $args;
        return $this;
    }

    public function getArgs(): array
    {
        return $this->args;
    }

    public function getArg($index): mixed
    {
        return $this->args[$index];
    }

    public function setArg(int $index, mixed $value): self
    {
        $this->args[$index] = $value;
        return $this;
    }

    public function getRepository(): IRepository
    {
        return $this->repository;
    }

    public function __invoke(): Result
    {
        return $this->execute();
    }

}
