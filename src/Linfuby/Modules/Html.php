<?php

namespace Linfuby\Modules;

class Html extends Module
{
    /**
     * @inheritdoc
     */
    public function render()
    {
        return htmlspecialchars($this->data['content'] ?? '', ENT_QUOTES, 'UTF-8');
    }

}
