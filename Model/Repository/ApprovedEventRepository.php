<?php
/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Model\Repository;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use LeviathanStudios\Scheduler\Api\Data;
use LeviathanStudios\Scheduler\Api\EventRequestRepositoryInterface;
use LeviathanStudios\Scheduler\Model\ResourceModel\EventRequest as EventResource;
use LeviathanStudios\Scheduler\Model\ResourceModel\EventRequest\CollectionFactory as EventCollectionFactory;

/**
 * Class EventRequestRepository
 */
class ApprovedEventRepository
{
    /**
     * @var EventResource $resource
     */
    private $resource;

    /**
     * @var EventRequestFactory $eventFactory
     */
    private $eventFactory;

    /**
     * @var EventCollectionFactory $eventCollectionFactory
     */
    private $eventCollectionFactory;

    /**
     * @var Data\EventRequestResultInterfaceFactory $searchResultsFactory
     */
    private $searchResultsFactory;

    /**
     * @var DataObjectHelper $dataObjectHelper
     */
    private $dataObjectHelper;

    /**
     * @var DataObjectProcessor $dataObjectProcessor
     */
    private $dataObjectProcessor;

    /**
     * @var \LeviathanStudios\Scheduler\Api\Data\EventRequestInterfaceFactory $dataEventFactory
     */
    private $dataEventFactory;

    /**
     * @var CollectionProcessorInterface $collectionProcessor
     */
    private $collectionProcessor;


    public function __construct(
        EventResource $resource,
        EventRequestFactory $eventFactory,
        Data\EventRequestInterfaceFactory $dataEventFactory,
        EventCollectionFactory $eventCollectionFactory,
        Data\EventRequestResultInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource               = $resource;
        $this->eventFactory           = $eventFactory;
        $this->eventCollectionFactory = $eventCollectionFactory;
        $this->searchResultsFactory   = $searchResultsFactory;
        $this->dataObjectHelper       = $dataObjectHelper;
        $this->dataEventFactory       = $dataEventFactory;
        $this->dataObjectProcessor    = $dataObjectProcessor;
        $this->collectionProcessor    = $collectionProcessor;
    }

    /**
     * Save the event.
     *
     * @param Data\EventRequestInterface $event
     * @return Data\EventRequestInterface
     * @throws CouldNotSaveException
     */
    public function save(Data\EventRequestInterface $event): Data\EventRequestInterface
    {

        try {
            $this->resource->save($event);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the estimate: %1', $exception->getMessage()),
                $exception
            );
        }

        return $event;
    }

    /**
     * Load event by id.
     *
     * @param int $id
     * @return Data\EventRequestInterface
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        /** @var EventRequest $estimateRequest */
        $event = $this->eventFactory->create();
        $event->load($id);
        if (!$event->getId()) {
            throw new NoSuchEntityException(__('Event with id "%1" does not exist.', $id));
        }

        return $estimateRequest;
    }
}
