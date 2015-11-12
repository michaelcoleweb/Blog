<?php

namespace MC\Blog\Block;

use Mc\Blog\Api\Data\PostInterface;
use Mc\Blog\Model\Resource\Post\Collection as PostCollection;

/**
 * Block used for listing posts
 *
 * @package MC\Blog\Block
 */
class PostList extends \Magento\Framework\View\Element\Template implements \Magento\Framework\DataObject\IdentityInterface
{
    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param \Mc\Blog\Model\Resource\Post\CollectionFactory    $postCollectionFactory,
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Mc\Blog\Model\Resource\Post\CollectionFactory $postCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_postCollectionFactory = $postCollectionFactory;
    }

    /**
     * @return \MC\Blog\Model\Resource\Post\Collection
     */
    public function getPosts()
    {
        if (!$this->hasData('posts')) {
            $posts = $this->_postCollectionFactory->create()
            ->addFieldToFilter('main_table.is_active', array('eq' => 1))
            ->addOrder(
                PostInterface::CREATION_TIME,
                PostCollection::SORT_ORDER_DESC
            );

            $posts->getSelect()->joinLeft(
                'admin_user',
                'main_table.admin_id = admin_user.user_id',
                ['username']
            );

            $this->setData('posts', $posts);
        }
        return $this->getData('posts');
    }

    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities()
    {
        return [\Mc\Blog\Model\Post::CACHE_TAG . '_' . 'list'];
    }
}
