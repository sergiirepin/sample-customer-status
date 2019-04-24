<?php

namespace Repin\CustomerStatus\Controller\Account;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;

class Status extends \Magento\Customer\Controller\AbstractAccount
{
    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * @var \Magento\Framework\Api\DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context                     $context
     * @param Session                     $customerSession
     * @param PageFactory                 $resultPageFactory
     * @param CustomerRepositoryInterface $customerRepository
     * @param DataObjectHelper            $dataObjectHelper
     */
    public function __construct(
        Context $context,
        Session $customerSession,
        PageFactory $resultPageFactory,
        CustomerRepositoryInterface $customerRepository,
        DataObjectHelper $dataObjectHelper
    ) {
        $this->session = $customerSession;
        $this->resultPageFactory = $resultPageFactory;
        $this->customerRepository = $customerRepository;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context);
    }


    public function execute()
    {
        /**
        * @var \Magento\Framework\View\Result\Page $resultPage
        */
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}
