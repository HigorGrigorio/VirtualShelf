<?php

namespace App\Domain\UseCases\User;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Result;
use App\Domain\UseCases\Base\CreateRecord;
use App\Interfaces\IUserRepository;
use Exception;
use Illuminate\Support\Str;

class CreateUser implements IUseCase
{
    public function __construct(
        public readonly IUserRepository $repository
    )
    {
    }

    public function execute($data): Result
    {
        try {
            $data['password'] = bcrypt($data['password']);

            // store user photo
            if ($data['photo']) {
                $filename = Str::uuid() . '.' . $data['photo']->extension();
                $data['photo'] = str_replace('public', 'storage', $data['photo']->storeAs('public/profile/images', $filename));
            }

            // TODO: replace this with builder pattern
            $result = (new CreateRecord($this->repository))->execute($data);
        } catch (Exception $e) {
            $result = Result::from($e);
        }
        return $result;
    }
}
