<?php

namespace Mc\Blog\Controller\View;

use \Magento\Framework\App\Action\Action;

/**
 * Post view controller
 *
 * @package Mc\Blog\Controller\View
 */
class Index extends Action
{
    /** @var  \Magento\Framework\View\Result\Page */
    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context                 $context
     * @param \Magento\Framework\Controller\Result\ForwardFactory   $resultForwardFactory
     */
    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory)
    {
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    /**
     * Show individual blog post
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $postId = $this->getRequest()->getParam('post_id', $this->getRequest()->getParam('id', false));
        /** @var \Mc\Blog\Helper\Post $postHelper */
        $postHelper = $this->_objectManager->get('Mc\Blog\Helper\Post');
        $resultPage = $postHelper->prepareResultPost($this, $postId);
        if (!$resultPage) {
            $resultForward = $this->resultForwardFactory->create();
            return $resultForward->forward('noroute');
        }

        return $resultPage;
    }
}
