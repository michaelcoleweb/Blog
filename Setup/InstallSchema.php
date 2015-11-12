<?php

namespace Mc\Blog\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * Install script for module
 *
 * @package Mc\Blog\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface      $setup
     * @param ModuleContextInterface    $context
     *
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $post = $installer->getConnection()
            ->newTable($installer->getTable('mc_blog_post'))
            ->addColumn('post_id', Table::TYPE_SMALLINT, null, [
                'identity'  => true,
                'nullable'  => false,
                'primary'   => true
            ], 'Post ID')
            ->addColumn('url_key', Table::TYPE_TEXT, 100, [
                'nullable'  => true,
                'default'   => null
            ], 'Post Url')
            ->addColumn('title', Table::TYPE_TEXT, 255, [
                'nullable'  => false
            ], 'Blog Title')
            ->addColumn('content', Table::TYPE_TEXT, '2M', [], 'Blog Content')
            ->addColumn('is_active', Table::TYPE_SMALLINT, null, [
                'nullable'  => false,
                'default'   => '1'
            ], 'Is Post Active?')
            ->addColumn('creation_time', Table::TYPE_DATETIME, null, [
                'nullable'  => false
            ], 'Creation Time')
            ->addColumn('update_time', Table::TYPE_DATETIME, null, [
                'nullable'  => false
            ], 'Update Time')
            ->addColumn('admin_id', Table::TYPE_INTEGER, null, [
                'nullable'  => false
            ], 'Admin ID')
            ->addIndex($installer->getIdxName('blog_post', ['url_key']), ['url_key'])
            ->setComment('Blog Posts');

        $installer->getConnection()->createTable($post);

        $commentTable = $installer->getConnection()
            ->newTable($installer->getTable('mc_blog_comment'))
            ->addColumn('comment_id', Table::TYPE_SMALLINT, null, [
                'identity'  => true,
                'nullable'  => false,
                'primary'   => true
            ], 'Comment ID')
            ->addColumn('post_id', Table::TYPE_INTEGER, null, [
                'nullable'  => false
            ], 'Post Id')
            ->addColumn('content', Table::TYPE_TEXT, '2M', [], 'Blog Content')
            ->addColumn('is_active', Table::TYPE_SMALLINT, null, [
                'nullable'  => false,
                'default'   => '1'
            ], 'Is Comment Active?')
            ->addColumn('creation_time', Table::TYPE_DATETIME, null, [
                'nullable'  => false
            ], 'Creation Time')
            ->addColumn('customer_id', Table::TYPE_SMALLINT, null, [
                'nullable'  => false
            ], 'Customer Id')
            ->setComment('Blog Comments');

        $installer->getConnection()->createTable($commentTable);

        $installer->endSetup();
    }
}
