<?php
/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

/**
 * Class EstimateActions
 *
 * @package LeviathanStudios\Scheduler\Ui\Component\Listing\Column
 */
class EstimateActions extends Column
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @param ContextInterface   $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface       $urlBuilder
     * @param array              $components
     * @param array              $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $storeId = $this->context->getFilterParam('store_id');
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')]['edit']   = [
                    'href'   => $this->urlBuilder->getUrl(
                        'scheduler/event/edit',
                        ['entity_id' => $item['entity_id'], 'store' => $storeId]
                    ),
                    'label'  => __('Edit'),
                    'hidden' => false,
                ];
                $item[$this->getData('name')]['delete'] = [
                    'href'   => $this->urlBuilder->getUrl(
                        'scheduler/event/delete',
                        ['entity_id' => $item['entity_id']]
                    ),
                    'label'  => __('Delete'),
                    'hidden' => false,
                ];
                $item[$this->getData('name')]['review'] = [
                    'href'   => $this->urlBuilder->getUrl(
                        'scheduler/event/reviewindex',
                        ['entity_id' => $item['entity_id']]
                    ),
                    'label'  => __('Review'),
                    'hidden' => false,
                ];
            }
        }

        return $dataSource;
    }
}
