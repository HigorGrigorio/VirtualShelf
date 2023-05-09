<?php

namespace App\Core\Infra\Traits;

trait Adapter
{
    static function adapt(array $object = []): self
    {
        if(count($object) > 0) {
            return new self(...$object);
        }

        return new self();
    }

    static function adaptAll(array $objects): array
    {
        return array_map(fn($object) => self::adapt($object), $objects);
    }
}
