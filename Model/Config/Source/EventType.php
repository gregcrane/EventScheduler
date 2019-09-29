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
class EventType implements OptionSourceInterface
{
    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'class', 'label' => __('Class')],
            ['value' => 'training_session', 'label' => __('Personal Training Session')],
            ['value' => 'pre_fight', 'label' => __('Pre Fight Training')],
            ['value' => 'special', 'label' => __('Special Training Session')],
            ['value' => 'event', 'label' => __('Event')]
        ];
    }
}


