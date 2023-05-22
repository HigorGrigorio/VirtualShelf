<?php

namespace App\Domain\UseCases\PublisherLanguage;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\UseCase;
use App\Http\Database\Contracts\PublisherLanguageRepository;
use Exception;

class CreatePublisherLanguage extends UseCase
{
    public function __construct(
        readonly PublisherLanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }

    public function execute(): Result
    {
        try {
            $args = $this->getArgs();

            if (!$args['publisher_id'] || !$args['language_id']) {
                throw new Exception('Missing arguments!');
            }

            $res = $this->repository->addLanguageToPublisher($args['publisher_id'], $args['language_id']);
            return Result::accept(
                Maybe::just($res),
                'Language added to publisher successfully!'
            );
        } catch (Exception $e) {
            return Result::from($e);
        }
    }
}
