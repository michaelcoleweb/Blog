<?php

namespace Mc\Blog\Api\Data;

/**
 * Interface CommentInterface
 * @package Mc\Blog\Api\Data
 */
interface CommentInterface
{
    /**
     * Constants for data stored in a post
     */
    const COMMENT_ID    = 'comment_id';
    const POST_ID       = 'post_id';
    const CONTENT       = 'content';
    const CREATION_TIME = 'creation_time';
    const IS_ACTIVE     = 'is_active';
    const CUSTOMER_ID   = 'customer_id';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getPostId();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime();

    /**
     * Get admin id
     *
     * @return int|null
     */
    public function getCustomerId();

    /**
     * Is active
     *
     * @return bool|null
     */
    public function isActive();

    /**
     * Set ID
     *
     * @param int $id
     *
     * @return \Mc\Blog\Api\Data\CommentInterface
     */
    public function setId($id);

    /**
     * Set post ID
     *
     * @param int $id
     *
     * @return \Mc\Blog\Api\Data\CommentInterface
     */
    public function setPostId($postId);

    /**
     * Set content
     *
     * @param string $content
     *
     * @return \Mc\Blog\Api\Data\CommentInterface
     */
    public function setContent($content);

    /**
     * Set creation time
     *
     * @param string $creation_time
     *
     * @return \Mc\Blog\Api\Data\CommentInterface
     */
    public function setCreationTime($creation_time);

    /**
     * Set Admin id of post
     *
     * @param int $customerId
     *
     * @return \Mc\Blog\Api\Data\CommentInterface
     */
    public function setCustomerId($customerId);

    /**
     * Set is active
     *
     * @param int|bool $is_active
     *
     * @return \Mc\Blog\Api\Data\CommentInterface
     */
    public function setIsActive($is_active);

}
