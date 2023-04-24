<?php

namespace App\Domain\UseCases\User;

use App\Core\Logic\Result;
use App\Domain\UseCases\Base\UpdateRecord;
use App\Domain\UseCases\UseCase;
use App\Presentation\Interfaces\IUserRepository;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateUser extends UseCase
{
    public function __construct(
        readonly IUserRepository $repository
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

            $user = $this->repository->getById($id);

            if ($user->isNothing()) {
                throw new Exception('User not found');
            }

            $data = $this->getArgs();

            // check for photo deletion
            if (isset($data['remove_photo']) && $data['remove_photo'] || $data['photo']) {
                // delete old photo
                if ($photo = $user->get()->photo) {
                    $path = str_replace('storage', 'public', $photo);
                    if (Storage::exists($path)) {
                        Storage::delete($path);
                    }
                }
            }

            // store user photo
            if ($data['photo']) {
                $filename = Str::uuid() . '.' . $data['photo']->extension();
                $data['photo'] = str_replace('public', 'storage', $data['photo']->storeAs('public/profile/images', $filename));
            }

            $result = UpdateRecord::create($this->repository)
                ->setArgs($data)
                ->execute();
        } catch (Exception $e) {
            $result = Result::from($e);
        }
        return $result;
    }
}
