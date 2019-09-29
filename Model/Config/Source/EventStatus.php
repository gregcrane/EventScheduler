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
 * Class MobileGrids
 *
 * @package LeviathanStudios\Scheduler\Model\Config\Source
 */
class EventStatus implements OptionSourceInterface
{
    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => __('Created')],
            ['value' => 1, 'label' => __('Viewed')],
            ['value' => 2, 'label' => __('Accepted')],
            ['value' => 3, 'label' => __('Completed')],
            ['value' => 4, 'label' => __('Reoccurring')]
        ];
    }
}


