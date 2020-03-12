<?php

use yii\db\Migration;

/**
 * Class m200312_033117_article_view
 */
class m200312_033117_article_view extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB comment "文章浏览次数记录"';
        }
        $this->createTable('article_view', [
            'articleId'     => $this->primaryKey()->notNull()->comment(''),
            'all'     => $this->integer(10)->notNull()->comment('总浏览次数'),
            'year'     => $this->integer(10)->comment('年浏览次数'),
            'month'     => $this->integer(10)->comment('月浏览次数'),
            'day'     => $this->integer(10)->comment('日浏览次数'),
            'yearUpdateTime'     => $this->integer(4)->comment('年浏览上次更新时间'),
            'monthUpdateTime'     => $this->integer(2)->comment('月浏览上次更新时间'),
            'dayUpdateTime'     => $this->integer(2)->comment('日浏览上次更新时间'),
        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200312_033117_article_view cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200312_033117_article_view cannot be reverted.\n";

        return false;
    }
    */
}
