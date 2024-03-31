<?php

namespace A17\Twill\Services\Forms;

use A17\Twill\Services\Forms\Contracts\CanHaveSubfields;
use A17\Twill\Services\Forms\Contracts\CanRenderForBlocks;
use A17\Twill\Services\Forms\Traits\HasSubFields;
use A17\Twill\Services\Forms\Traits\RenderForBlocks;

class ConnectedField implements CanRenderForBlocks, CanHaveSubfields
{
    use HasSubFields;
    use RenderForBlocks;

    public function render()
    {
        return view('twill::partials.form.utils._connected_fields', [
            ...$this->connectedTo,
            'renderForBlocks' => $this->forBlocks(),
            'slot' => $component->render(),
        ]);
    }
}
