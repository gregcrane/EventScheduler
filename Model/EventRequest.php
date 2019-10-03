<?php
/**
 * @package     LeviathanStudios/Scheduler
 * @version     1.0.0
 * @author      Greg Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Model;

use LeviathanStudios\Scheduler\Api\Data\EventRequestInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class EventRequest
 *
 * Model class used for the manipulation of the event request data. This data will only be
 * around for a finite amount of time for more efficient queries.
 *
 * @package LeviathanStudios\Scheduler\Model
 */
class EventRequest extends AbstractModel implements EventRequestInterface, IdentityInterface
{
    const CACHE_TAG = 'leviathanstudios_event_request';
    protected $_cacheTag = 'leviathanstudios_event_request';
    protected $_eventPrefix = 'leviathanstudios_event_request';

    /**
     * Model construct that should be used for object initialization.
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('LeviathanStudios\Scheduler\Model\ResourceModel\EventRequest');
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
     * Get the event type.
     *
     * @return string|null
     */
    public function getType()
    {
        return parent::getData(self::TYPE);
    }

    /**
     * Get the store customer
     *
     * @return int|null
     */
    public function getCustomerId()
    {
        return parent::getData(self::CUSTOMER_ID);
    }

    /**
     * Get the event status.
     *
     * @return int|null
     */
    public function getStatus()
    {
        return parent::getData(self::STATUS);
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
     * Get the customer telephone number.
     *
     * @return string|null
     */
    public function getTelephone()
    {
        return parent::getData(self::TELEPHONE);
    }

    /**
     * Get the email address.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return parent::getData(self::EMAIL);
    }

    /**
     * Get the event start time.
     *
     * @return mixed
     */
    public function getStartTime()
    {
        return parent::getData(self::START_TIME);
    }

    /**
     * Get the event end time.
     *
     * @return mixed
     */
    public function getEndTime()
    {
        return parent::getData(self::END_TIME);
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
     * Get Message.
     *
     * @return mixed|string|null
     */
    public function getMessage()
    {
        return parent::getData(self::MESSAGE);
    }

    /**
     * Set the row id.
     *
     * @param $entityId
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Set the event type
     *
     * @param  $type
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setType($type)
    {
        return $this->setData(self::TYPE, $type);
    }

    /**
     * Set the customer id.
     *
     * @param $id
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setCustomerId($id)
    {
        return $this->setData(self::CUSTOMER_ID, $id);
    }

    /**
     * Set the event status.
     *
     * @param $status
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Set the customer name.
     *
     * @param $name
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Set the customer telephone.
     *
     * @param $telephone
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setTelephone($telephone)
    {
        return $this->setData(self::TELEPHONE, $telephone);
    }


    /**
     * Set the customer email.
     *
     * @param $email
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Set the event start time.
     *
     * @param $time
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setStartTime($time)
    {
        return $this->setData(self::START_TIME, $time);
    }

    /**
     * Set the event end time.
     *
     * @param $time
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setEndTime($time)
    {
        return $this->setData(self::END_TIME, $time);
    }

    /**
     * Set the event date.
     *
     * @param $date
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setDate($date)
    {
        return $this->setData(self::DATE, $date);
    }

    /**
     * Set the customer message.
     *
     * @param $message
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setMessage($message)
    {
        return $this->setData(self::MESSAGE, $message);
    }
}
