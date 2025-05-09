<?php

use yii\db\Migration;

/**
 * Class m200312_033045_article_data
 */
class m200312_033045_article_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB comment "文章内容"';
        }
        $this->createTable('article_data', [
            'articleId'     => $this->primaryKey()->notNull()->comment('主键id'),
            'content'     => $this->text()->notNull()->comment('文章内容'),
        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200312_033045_article_data cannot be reverted.\n";
        $this->dropTable($this->table);

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200312_033045_article_data cannot be reverted.\n";

        return false;
    }
    */
}
