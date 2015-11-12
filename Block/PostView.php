<?php

namespace Mc\Blog\Block;

use Mc\Blog\Api\Data\PostInterface;
use Mc\Blog\Model\Resource\Post\Collection as PostCollection;
use Magento\Framework\ObjectManagerInterface;

/**
 * Block used for individual posts
 *
 * @package Mc\Blog\Block
 */
class PostView extends \Magento\Framework\View\Element\Template implements \Magento\Framework\DataObject\IdentityInterface
{

    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param \Mc\Blog\Model\Post                               $post
     * @param \Mc\Blog\Model\PostFactory                        $postFactory
     * @param array                                             $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Mc\Blog\Model\Post $post,
        \Mc\Blog\Model\PostFactory $postFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_post = $post;
        $this->_postFactory = $postFactory;
    }

    /**
     * @return \Mc\Blog\Model\Post
     */
    public function getPost()
    {
        if (!$this->hasData('post')) {
            if ($this->getPostId()) {
                /** @var \Mc\Blog\Model\Post $page */
                $post = $this->_postFactory->create();

            } else {
                $post = $this->_post;
            }
            $this->setData('post', $post);
        }

        return $this->getData('post');
    }

    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities()
    {
        return [\Mc\Blog\Model\Post::CACHE_TAG . '_' . $this->getPost()->getId()];
    }
}
