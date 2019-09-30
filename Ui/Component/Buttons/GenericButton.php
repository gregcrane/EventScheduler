<?php
/**
 * @package     LeviathanStudios/Scheduler
 * @version     1.0.0
 * @author      Greg Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Ui\Component\Buttons;

use LeviathanStudios\Scheduler\Model\EventRequest;
use LeviathanStudios\Scheduler\Model\EventRequestFactory;
use LeviathanStudios\Scheduler\Model\ResourceModel\EventRequest as EventRequestResource;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;

/**
 * Class GenericButton
 *
 * Class for common code for buttons on the create/edit event form
 *
 * @package LeviathanStudios\Scheduler\Ui\Component\Buttons
 */
class GenericButton
{
    /**
     * @var UrlInterface $urlBuilder
     */
    private $urlBuilder;

    /**
     * @var RequestInterface $request
     */
    private $request;

    /**
     * @var EventRequestFactory $eventFactory
     */
    private $eventFactory;

    /**
     * @var EventRequestResource $eventResource
     */
    private $eventResource;

    /**
     * @param UrlInterface         $urlBuilder
     * @param RequestInterface     $request
     * @param EventRequestFactory  $eventFactory
     * @param EventRequestResource $eventResource
     */
    public function __construct(
        UrlInterface $urlBuilder,
        RequestInterface $request,
        EventRequestFactory $eventFactory,
        EventRequestResource $eventResource
    ) {
        $this->urlBuilder    = $urlBuilder;
        $this->request       = $request;
        $this->eventFactory  = $eventFactory;
        $this->eventResource = $eventResource;
    }

    /**
     * Get estimate id.
     *
     * @return int|null
     */
    public function getId()
    {
        /**
         * @var EventRequest $estimate
         */
        $estimate = $this->eventFactory->create();

        $entityId = $this->request->getParam('entity_id');
        $this->eventResource->load(
            $estimate,
            $entityId
        );

        return $estimate->getEntityId() ?: null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array  $params
     * @return  string
     */
    public function getUrl($route = '', array $params = []): string
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}
