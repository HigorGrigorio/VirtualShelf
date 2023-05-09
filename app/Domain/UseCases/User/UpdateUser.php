<?php

namespace App\Domain\UseCases\User;

use App\Core\Logic\Result;
use App\Domain\UseCases\Base\UpdateRecord;
use App\Domain\UseCases\UseCase;
use App\Http\Database\Contracts\UserRepository;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateUser extends UseCase
{
    public function __construct(
        readonly UserRepository $repository
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

            $findResult = $this->repository->getById($id);

            if ($findResult->isNothing()) {
                throw new Exception('User not found');
            }

            $data = $this->getArgs();

            $user = $findResult->get();

            // check for photo deletion
            if (isset($data['remove_photo']) && $data['remove_photo'] || $data['photo']) {
                // delete old photo
                if ($photo = $user->photo) {
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
                $user->photo = $data['photo'];
            }

            $user->name = $data['name'];
            $user->email = $data['email'];

            $result = UpdateRecord::create($this->repository)
                ->setArgs($user->toArray())
                ->execute();
        } catch (Exception $e) {
            $result = Result::from($e);
        }
        return $result;
    }
}
