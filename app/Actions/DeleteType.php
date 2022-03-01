<?php

namespace App\Actions;

use App\Models\Ingredient;
use App\Models\Type;

class DeleteType implements Action
{
    public function execute(Type $type, bool $retry = false)
    {
        Ingredient::where('type_id', $type->id)
            ->update(['type_id' => $this->getDefaultType()->id]);

        if ($type->ingredients->count() >= 1) {
            if ($retry === false) {
                return $this->execute($type, true);
            }

            return false;
        }

        return $type->delete();
    }

    protected function getDefaultType(): Type
    {
        return Type::firstOrCreate(config('fallback.type'));
    }
}
