<?php

namespace Mc\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Mc_Blog::post';

    protected $resultPageFactory;

    public function __construct (
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Mc_Blog::post');
        $resultPage->addBreadCrumb(__('Blog Posts'), __('Blog Posts'));
        $resultPage->addBreadCrumb(__('Manage Blog Posts'), __('Manage Blog Posts'));
        $resultPage->getConfig()->getTitle()->prepend(__('Blog Posts'));

        return $resultPage;
    }
}
