<?php

namespace WPC2O;

class Order
{
    /**
     * @todo fetch full list of order history in any status
     */
    public function getFullHistory(): array
    {
        return [];
    }

    /**
     * @todo push full history list to a view
     */
    public function getFullHistoryView(): string
    {
        return '<h2>Full order history</h2>';
    }
}
