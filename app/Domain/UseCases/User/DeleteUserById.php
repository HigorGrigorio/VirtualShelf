<?php

namespace App\Domain\UseCases\User;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\Base\DeleteRecord;
use App\Interfaces\IUserRepository;
use Exception;
use Illuminate\Support\Facades\Storage;

class DeleteUserById implements IUseCase
{
    public function __construct(
        readonly IUserRepository $repository
    )
    {
    }

    public function execute($data): Result
    {
        try {
            $user = $this->repository->getById($data['id']);

            if($user->isNothing()) {
                throw new Exception('User not found');
            }

            // delete user photo if exists
            if ($photo = $user->get()->photo) {
                $path = str_replace('storage', 'public', $photo);
                if(Storage::exists($path)) {
                    Storage::delete($path);
                }
            }

            $result = (new DeleteRecord($this->repository))->execute($data);
        } catch (Exception $e) {
            $result = Result::from($e);
        }
        return $result;
    }
}
