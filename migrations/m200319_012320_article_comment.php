<?php

use yii\db\Migration;

/**
 * Class m200319_012320_article_comment
 */
class m200319_012320_article_comment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB comment "article_comment"';
        }
        $this->createTable('article_comment', [
            'commentId'     => $this->primaryKey()->notNull()->comment(''),
            'articleId'     => $this->integer(11)->notNull()->comment('文章id'),
            'userId'     => $this->integer(11)->notNull()->comment('用户'),
            'parentId'     => $this->integer(11)->notNull()->comment('评论父id'),
            'status'     => $this->integer(1)->defaultValue(1)->comment('状态'),
            'content'     => $this->string(1500)->notNull()->comment('内容'),
            'createTime' => $this->dateTime()->comment('创建暗井'),
        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200319_012320_article_comment cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200319_012320_article_comment cannot be reverted.\n";

        return false;
    }
    */
}
