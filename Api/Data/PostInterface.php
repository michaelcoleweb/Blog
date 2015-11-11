<?php

namespace Mc\Blog\Api\Data;

/**
 * Interface PostInterface
 * @package Mc\Blog\Api\Data
 */
interface PostInterface
{
    /**
     * Constants for data stored in a post
     */
    const POST_ID       = 'post_id';
    const URL_KEY       = 'url_key';
    const TITLE         = 'title';
    const CONTENT       = 'content';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME   = 'update_time';
    const IS_ACTIVE     = 'is_active';

    /**
     * Get the post id
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get the post url slug
     *
     * @return string
     */
    public function getUrlKey();

    /**
     * Get the post title
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Get the post content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Get the post creation time
     *
     * @return string|null
     */
    public function getCreationTime();

    /**
     * Get teh post last updated time
     *
     * @return string|null
     */
    public function getUpdateTime();

    /**
     * Get post display state
     *
     * @return bool|null
     */
    public function isActive();

    /**
     * @param int $id
     *
     * @return \Mc\Blog\Api\Data\PostInterface
     */
    public function setId($id);

    /**
     * Set URL Key
     *
     * @param string $url_key
     *
     * @return \Mc\Blog\Api\Data\PostInterface
     */
    public function setUrlKey($url_key);

    /**
     * Set title
     *
     * @param string $title
     *
     * @return \Mc\Blog\Api\Data\PostInterface
     */
    public function setTitle($title);

    /**
     * Set content
     *
     * @param string $content
     *
     * @return \Mc\Blog\Api\Data\PostInterface
     */
    public function setContent($content);

    /**
     * Set creation time
     *
     * @param string $creationTime
     *
     * @return \Mc\Blog\Api\Data\PostInterface
     */
    public function setCreationTime($creationTime);

    /**
     * Set update time
     *
     * @param string $updateTime
     *
     * @return \Mc\Blog\Api\Data\PostInterface
     */
    public function setUpdateTime($updateTime);

    /**
     * Set is active
     *
     * @param int|bool $isActive
     *
     * @return \Mc\Blog\Api\Data\PostInterface
     */
    public function setIsActive($isActive);
}
