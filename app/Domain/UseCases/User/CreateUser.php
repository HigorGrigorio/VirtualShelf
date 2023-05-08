<?php

namespace App\Domain\UseCases\User;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Result;
use App\Domain\UseCases\Base\CreateRecord;
use App\Domain\UseCases\UseCase;
use App\Presentation\Contracts\IUserRepository;
use Exception;
use Illuminate\Support\Str;

class CreateUser extends UseCase
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
            $data = $this->getArgs();
            $data['password'] = bcrypt($data['password']);

            // store user photo
            if ($data['photo']) {
                $filename = Str::uuid() . '.' . $data['photo']->extension();
                $data['photo'] = str_replace('public', 'storage', $data['photo']->storeAs('public/profile/images', $filename));
            }

            $result = CreateRecord::create($this->getRepository())
                ->setArgs($data)
                ->execute();
        } catch (Exception $e) {
            $result = Result::from($e);
        }
        return $result;
    }


}
