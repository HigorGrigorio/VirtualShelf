<?php

namespace App\Domain\UseCases\Base;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\UseCase;
use App\Presentation\Contracts\IRepository;
use Exception;

class UpdateRecord extends UseCase
{
    public function __construct(
        IRepository $repository
    )
    {
        parent::__construct($repository);
    }

    public function execute(): Result
    {
        try {
            if ($this->getArg('id') === null)
                $result = Result::reject(
                    Maybe::nothing(),
                    'Record id is required'
                );
            else {
                $data = $this->getArgs();
                $id = $data['id'];
                unset($data['id']);

                if (!$this->getRepository()->update($data, compact('id')))
                    $result = Result::reject(
                        Maybe::nothing(),
                        'Record not found'
                    );
                else
                    $result = Result::accept(
                        Maybe::flat(
                            $this->getRepository()->getById($id)
                        ),
                        'Record updated successfully'
                    );
            }

        } catch (Exception $e) {
            $result = Result::from($e);
        }

        return $result;
    }

    public static function create(IRepository $repository): UpdateRecord
    {
        return new self($repository);
    }
}
