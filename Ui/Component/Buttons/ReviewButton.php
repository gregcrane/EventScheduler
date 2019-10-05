<?php
/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Ui\Component\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class ReviewButton
 *
 * Button class responsible for navigating the user to the review page.
 *
 * @package LeviathanStudios\Scheduler\Ui\Component\Buttons
 */
class ReviewButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Get review button data.
     *
     * @return array
     */
    public function getButtonData(): array
    {
        $data = [];
        if ($this->getId()) {
            $data = [
                'id'         => 'review',
                'label'      => __('Review Event'),
                'on_click'   => "deleteConfirm('" . __('Review this event?') . "', '"
                    . $this->getReviewUrl() . "', {data: {}})",
                'class'      => 'review-button-top',
                'sort_order' => 5
            ];
        }

        return $data;
    }

    /**
     * Get review button url.
     *
     * @return string
     */
    public function getReviewUrl(): string
    {
        return $this->getUrl('*/*/reviewindex', ['entity_id' => $this->getId()]);
    }
}
