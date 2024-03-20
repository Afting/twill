<?php

namespace A17\Twill\Services\Forms\Traits;

use A17\Twill\Services\Forms\Contracts\CanHaveSubfields;

trait HasSubFields
{
    public function registerDynamicRepeaters(): void
    {
        if (is_iterable($this)) {
            $this->registerDynamicRepeatersFor($this);
        }
    }

    protected function registerDynamicRepeatersFor(?iterable $fields): void
    {
        if ($fields) {
            foreach ($fields as $field) {
                if ($field instanceof CanHaveSubfields) {
                    $field->registerDynamicRepeaters();
                }
            }
        }
    }
}
