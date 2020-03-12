<?php

use yii\db\Migration;

/**
 * Class m200312_033106_article_recommend
 */
class m200312_033106_article_recommend extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB comment "文章推荐位设置"';
        }
        $this->createTable('article_recommend', [
            'recommendId'     => $this->primaryKey()->notNull()->comment('主键'),
            'title'     => $this->string(100)->notNull()->comment('标题'),
            'createTime'     => $this->integer(10)->notNull()->comment('创建时间'),
            'updateTime'     => $this->integer(10)->notNull()->comment('修改时间'),
        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200312_033106_article_recommend cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200312_033106_article_recommend cannot be reverted.\n";

        return false;
    }
    */
}
