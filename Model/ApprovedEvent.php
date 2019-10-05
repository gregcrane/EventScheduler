<?php

declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Model;

use LeviathanStudios\Scheduler\Api\Data\ApprovedEventInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class ApprovedEvent
 *
 * Model class used for the manipulation of the approved event data. This data will
 * be used for report generation.
 *
 * @package LeviathanStudios\Scheduler\Model
 */
class ApprovedEvent extends AbstractModel implements ApprovedEventInterface, IdentityInterface
{
    /** @var string */
    const CACHE_TAG = 'leviathanstudios_approved_event';

    /** @var string */
    protected $_cacheTag = 'leviathanstudios_approved_event';

    /** @var string */
    protected $_eventPrefix = 'leviathanstudios_approved_event';

    /**
     * Model construct that should be used for object initialization.
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('LeviathanStudios\Scheduler\Model\ResourceModel\ApprovedEvent');
    }

    /**
     *  Return unique ID(s) for each object in system
     *
     * @return array|string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get the row ID
     *
     * @return int|null
     */
    public function getId()
    {
        return parent::getData(self::ENTITY_ID);
    }

    /**
     * @return string|null
     */
    public function getType()
    {
        return parent::getData(self::TYPE);
    }

    /**
     * Get the customer name.
     *
     * @return string|null
     */
    public function getName()
    {
        return parent::getData(self::NAME);
    }

    /**
     * Get the event date.
     *
     * @return mixed
     */
    public function getDate()
    {
        return parent::getData(self::DATE);
    }

    /**
     * Set the row id.
     *
     * @param $entityId
     * @return \LeviathanStudios\Scheduler\Api\Data\ApprovedEventInterface
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Set the event type
     *
     * @param  $type
     * @return \LeviathanStudios\Scheduler\Api\Data\ApprovedEventInterface
     */
    public function setType($type)
    {
        return $this->setData(self::TYPE, $type);
    }

    /**
     * Set the customer name.
     *
     * @param $name
     * @return \LeviathanStudios\Scheduler\Api\Data\ApprovedEventInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Set the event date.
     *
     * @param $date
     * @return \LeviathanStudios\Scheduler\Api\Data\ApprovedEventInterface
     */
    public function setDate($date)
    {
        return $this->setData(self::DATE, $date);
    }
}
