<?php
/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Controller\Adminhtml\Event;

use LeviathanStudios\Scheduler\Api\EventRequestRepositoryInterface;
use LeviathanStudios\Scheduler\Model\EventRequestFactory;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Controller class responsible for deleting an event.
 */
class Delete extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'LeviathanStudios_Scheduler::scheduler';

    /** @var JsonFactory $resultJsonFactory */
    private $resultJsonFactory;

    /** @var PageFactory $resultPageFactory */
    private $resultPageFactory;

    /** @var EventRequestRepositoryInterface $eventRepository */
    private $eventRepository;

    /** @var EventRequestFactory $eventFactory */
    private $eventFactory;

    /**
     * @param Action\Context                  $context
     * @param PageFactory                     $resultPageFactory
     * @param JsonFactory                     $resultJsonFactory
     * @param EventRequestRepositoryInterface $eventRepository
     * @param EventRequestFactory             $eventFactory
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory,
        EventRequestRepositoryInterface $eventRepository,
        EventRequestFactory $eventFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->eventRepository   = $eventRepository;
        $this->eventFactory      = $eventFactory;
    }

    /**
     * Delete the selected event.
     *
     * @return Redirect|ResponseInterface|ResultInterface
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id = $this->getRequest()->getParam('entity_id')) {
            try {
                $this->eventRepository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('This event has been successfully deleted.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('An error has occurred please try again.'));
            }
        }

        return $resultRedirect->setPath('*/*/');
    }
}
