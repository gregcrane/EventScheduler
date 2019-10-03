<?php
/**
 * @package     LeviathanStudios/RequestContact
 * @version     1.0.0
 * @author      Greg Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Ui\Component\DataSource\Event\Form;

use LeviathanStudios\Scheduler\Model\EventRequest;
use LeviathanStudios\Scheduler\Model\ResourceModel\EventRequest\Collection;
use LeviathanStudios\Scheduler\Model\ResourceModel\EventRequest\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * DataProvider class used for the event admin form.
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var StoreManagerInterface $storeManager
     */
    private $storeManager;

    /**
     * @var Collection $collection
     */
    protected $collection;

    /**
     * @var Collection $loadedData
     */
    protected $loadedData;

    /**
     * @var CollectionFactory  $eventCollectionFactory
     */
    protected $eventCollectionFactory;

    /**
     * @param StoreManagerInterface $storeManager
     * @param                       $name
     * @param                       $primaryFieldName
     * @param                       $requestFieldName
     * @param CollectionFactory     $eventCollectionFactory
     * @param array                 $meta
     * @param array                 $data
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $eventCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->eventCollectionFactory = $eventCollectionFactory;
        $this->storeManager             = $storeManager;
        $this->collection               = $eventCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array|Collection
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->eventCollectionFactory->create()->getItems();

        /** @var EventRequest $event */
        foreach ($items as $event) {
            $this->loadedData[$event->getId()] = $event->getData();
        }

        return $this->loadedData;
    }

    /**
     * Return the request param id field.
     *
     * @return string
     */
    public function getRequestFieldName(): string
    {
        return 'entity_id';
    }
}
