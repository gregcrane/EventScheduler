<?php
/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Api\Data;

/**
 * Interface EventRequestInterface
 */
interface EventRequestInterface
{
    const ENTITY_ID        = 'entity_id';
    const TYPE             = 'type';
    const CUSTOMER_ID      = 'customer_id';
    const STATUS           = 'status';
    const NAME             = 'name';
    const EMAIL            = 'email';
    const TELEPHONE        = 'telephone';
    const START_TIME       = 'start_time';
    const START_TIME_STAMP = 'start_time_stamp';
    const END_TIME         = 'end_time';
    const END_TIME_STAMP   = 'end_time_stamp';
    const DATE             = 'date';
    const MESSAGE          = 'message';
    const WEEKDAY          = 'weekday';

    /**
     * Get the row id.
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get the event type.
     *
     * @return string|null
     */
    public function getType();

    /**
     * Get the customer id.
     *
     * @return int|null
     */
    public function getCustomerId();

    /**
     * Get the event status.
     *
     * @return int|null
     */
    public function getStatus();

    /**
     * Get the customer name.
     *
     * @return string|null
     */
    public function getName();

    /**
     * Get the customer telephone.
     *
     * @return string|null
     */
    public function getTelephone();

    /**
     * Get the customer email address.
     *
     * @return string|null
     */
    public function getEmail();

    /**
     * Get the event start time.
     *
     * @return mixed
     */
    public function getStartTime();

    /**
     * Get the event start timestamp.
     *
     * @return mixed
     */
    public function getStartTimeStamp();

    /**
     * Get the event end time.
     *
     * @return mixed
     */
    public function getEndTime();

    /**
     * Get the event end timestamp.
     *
     * @return mixed
     */
    public function getEndTimeStamp();

    /**
     * Get the event date.
     *
     * @return mixed
     */
    public function getDate();

    /**
     * Get the customer optional message.
     *
     * @return string|null
     */
    public function getMessage();

    /**
     * Get the weekday.
     *
     * @return string|null
     */
    public function getWeekday();

    /**
     * Set the row id.
     *
     * @param $entityId
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setEntityId($entityId);

    /**
     * Set the event type
     *
     * @param  $type
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setType($type);

    /**
     * Set the customer id.
     *
     * @param $id
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setCustomerId($id);

    /**
     * Set the event status.
     *
     * @param $status
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setStatus($status);

    /**
     * Set the customer name.
     *
     * @param $name
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setName($name);

    /**
     * Set the customer telephone.
     *
     * @param $telephone
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setTelephone($telephone);

    /**
     * Set the customer phone number.
     *
     * @param $email
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setEmail($email);

    /**
     * Set the event start time.
     *
     * @param $time
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setStartTime($time);

    /**
     * Set the event start timestamp.
     *
     * @param $time
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setStartTimeStamp($time);

    /**
     * Set the event end time.
     *
     * @param $time
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setEndTime($time);

    /**
     * Set the event end timestamp.
     *
     * @param $time
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setEndTimeStamp($time);

    /**
     * Set the event date.
     *
     * @param $date
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setDate($date);

    /**
     * Set the customer optional message.
     *
     * @param $message
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setMessage($message);

    /**
     * Set the weekday.
     *
     * @param $weekday
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setWeekday($weekday);
}
