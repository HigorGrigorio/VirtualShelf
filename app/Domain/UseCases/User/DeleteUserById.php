<?php

namespace App\Domain\UseCases\User;

use App\Core\Logic\Result;
use App\Domain\UseCases\Base\DeleteRecord;
use App\Domain\UseCases\UseCase;
use App\Presentation\Contracts\IUserRepository;
use Exception;
use Illuminate\Support\Facades\Storage;

class DeleteUserById extends UseCase
{
    public function __construct(
        IUserRepository $repository
    )
    {
        parent::__construct($repository);
    }

    public function execute(): Result
    {
        try {
            $id = $this->getArg('id');

            if ($id === null) {
                throw new Exception('Id is required');
            }

            $user = $this->getRepository()->getById($id);

            if ($user->isNothing()) {
                throw new Exception('User not found');
            }

            // delete user photo if exists
            if ($photo = $user->get()->photo) {
                $path = str_replace('storage', 'public', $photo);
                if (Storage::exists($path)) {
                    Storage::delete($path);
                }
            }

            $result = DeleteRecord::create($this->getRepository())
                ->setArgs(['id' => $id])
                ->execute();
        } catch (Exception $e) {
            $result = Result::from($e);
        }
        return $result;
    }
}
