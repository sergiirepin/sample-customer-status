<?php

namespace Repin\CustomerStatus\Plugin\Block;

class Header
{
    public function afterGetTemplate($block, $template)
    {
        return 'Repin_CustomerStatus::html/header.phtml';
    }
}
