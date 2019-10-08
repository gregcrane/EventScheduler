<?php
/**
 * @package     LeviathanStudios/Scheduler
 * @version     1.0.0
 * @author      Greg Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Model class that houses the different status values and labels.
 */
class EventStatus implements OptionSourceInterface
{
    const CLASS_STATUS = 4;

    /**
     * Return an array of status values.
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => ' ', 'label' => 'Please Select a Status'],
            ['value' => 0, 'label' => __('Created')],
            ['value' => 1, 'label' => __('Viewed')],
            ['value' => 2, 'label' => __('Accepted')],
            ['value' => 3, 'label' => __('Completed')],
            ['value' => 4, 'label' => __('Reoccurring')]
        ];
    }
}


