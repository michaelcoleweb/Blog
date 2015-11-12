<?php
namespace MC\Blog\Block;

use Mc\Blog\Api\Data\PostInterface;
use Mc\Blog\Model\Resource\Post\Collection as PostCollection;

class PostList extends \Magento\Framework\View\Element\Template implements
    \Magento\Framework\DataObject\IdentityInterface
{

    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Ashsmith\Blog\Model\Resource\Post\CollectionFactory $postCollectionFactory,
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
        // Check if posts has already been defined
        // makes our block nice and re-usable! We could
        // pass the 'posts' data to this block, with a collection
        // that has been filtered differently!
        if (!$this->hasData('posts')) {
            $posts = $this->_postCollectionFactory
                ->create()
                ->addFieldToFilter('is_active', array('eq' => 1))
                ->addOrder(
                    PostInterface::CREATION_TIME,
                    PostCollection::SORT_ORDER_DESC
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