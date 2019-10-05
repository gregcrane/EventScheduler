<?php
/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Api\Data;

/**
 * Data model representing an event.
 *
 * @api
 */
interface ApprovedEventInterface
{
    const ENTITY_ID = 'entity_id';
    const TYPE      = 'type';
    const NAME      = 'name';
    const DATE      = 'date';

    /**
     * Get row id.
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
     * Get the customer name.
     *
     * @return string|null
     */
    public function getName();


    /**
     * Get the event date.
     *
     * @return mixed
     */
    public function getDate();

    /**
     * Get row id.
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
     * Set the customer name.
     *
     * @param $name
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setName($name);


    /**
     * Set the event date.
     *
     * @param $date
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function setDate($date);
}
