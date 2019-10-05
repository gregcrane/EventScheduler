<?php
/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Ui\Component\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class DeleteButton
 *
 * Button class responsible for deleting the event.
 *
 * @package LeviathanStudios\Scheduler\Ui\Component\Buttons
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Get delete button data.
     *
     * @return array
     */
    public function getButtonData(): array
    {
        $data = [];
        if ($this->getId()) {
            $data = [
                'id'         => 'delete',
                'label'      => __('Delete'),
                'on_click'   => "deleteConfirm('" . __('Are you sure you want to delete this event?') . "', '"
                    . $this->getDeleteUrl() . "', {data: {}})",
                'class'      => 'delete',
                'sort_order' => 10
            ];
        }

        return $data;
    }

    /**
     * Get delete button url.
     *
     * @return string
     */
    public function getDeleteUrl(): string
    {
        return $this->getUrl('*/*/delete', ['entity_id' => $this->getId()]);
    }
}
