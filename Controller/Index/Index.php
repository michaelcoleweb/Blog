<?php

namespace Mc\Blog\Controller\Index;

use \Magento\Framework\App\Action\Action;

class Index extends Action
{
    /** @var  \Magento\Framework\View\Result\Page  */
    protected $resultPageFactory;

    /**
     * Constructer
     *
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Render the blog index page
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        var_dump('test');
        return $this->resultPageFactory->create();
    }
}