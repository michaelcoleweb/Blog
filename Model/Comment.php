<?php

namespace Mc\Blog\Model;

use Mc\Blog\Api\Data\CommentInterface;
use Magento\Framework\DataObject\IdentityInterface;

/**
 * Post object class
 *
 * @package Mc\Blog\Model
 */
class Comment extends \Magento\Framework\Model\AbstractModel implements CommentInterface, IdentityInterface
{
    /**
     * Post status options
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'blog_comment';

    /**
     * @var string
     */
    protected $_cacheTag = 'blog_comment';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'blog_comment';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Mc\Blog\Model\Resource\Comment');
    }

    /**
     * Prepare post's statuses.
     *
     * Available event blog_post_get_available_statuses to customize statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::COMMENT_ID);
    }

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getPostId()
    {
        return $this->getData(self::POST_ID);
    }

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * Get admin id
     *
     * @return int|null
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * Is active
     *
     * @return bool|null
     */
    public function isActive()
    {
        return (bool) $this->getData(self::IS_ACTIVE);
    }

    /**
     * Set ID
     *
     * @param int $id
     *
     * @return \Mc\Blog\Api\Data\CommentInterface
     */
    public function setId($id)
    {
        return $this->setData(self::COMMENT_ID, $id);
    }

    /**
     * Set post ID
     *
     * @param int $postId
     *
     * @return \Mc\Blog\Api\Data\CommentInterface
     */
    public function setPostId($postId)
    {
        return $this->setData(self::POST_ID, $postId);
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return \Mc\Blog\Api\Data\CommentInterface
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Set creation time
     *
     * @param string $creation_time
     *
     * @return \Mc\Blog\Api\Data\CommentInterface
     */
    public function setCreationTime($creation_time)
    {
        return $this->setData(self::CREATION_TIME, $creation_time);
    }

    /**
     * Set Admin id of post
     *
     * @param int $customerId
     *
     * @return \Mc\Blog\Api\Data\CommentInterface
     */
    public function setCustomerId($customerId)
    {
        return $this->setAdminId(self::CUSTOMER_ID, $customerId);
    }

    /**
     * Set is active
     *
     * @param int|bool $is_active
     *
     * @return \Mc\Blog\Api\Data\CommentInterface
     */
    public function setIsActive($is_active)
    {
        return $this->setData(self::IS_ACTIVE, $is_active);
    }
}
