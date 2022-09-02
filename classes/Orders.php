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
        $content = '<h2>Full order history</h2>';
        $content .= '<div style="padding: 0 12px">';

        $orders = $this->getFullHistory();
        if (count($orders) <= 0) {
            $content .= '<p>No orders to show</p>';
        } else {
            // pass to template
            $content .= '<p>TODO</p>';
        }
        $content .= '</div>';
        return $content;
    }
}
