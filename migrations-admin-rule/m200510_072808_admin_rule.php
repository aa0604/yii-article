<?php

use yii\db\Migration;

/**
 * Class m200510_072808_admin_rule
 */
class m200510_072808_admin_rule extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert($this->table, [
            'pid'       => 0,
            'title'     => '文章内容',
            'route'     => null,
            'type'      => 1,
            'is_show'   => 1,
            'status'    => 1
        ]);

        $this->insert($this->table, [
            'pid'       => 1,
            'title'     => '分类管理',
            'route'     => 'article/category/index',
            'type'      => 1,
            'is_show'   => 1,
            'status'    => 1
        ]);

        $this->insert($this->table, [
            'pid'       => 1,
            'title'     => '内容管理',
            'route'     => 'article/article/index',
            'type'      => 1,
            'is_show'   => 1,
            'status'    => 1
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200510_072808_admin_rule cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200510_072808_admin_rule cannot be reverted.\n";

        return false;
    }
    */
}
