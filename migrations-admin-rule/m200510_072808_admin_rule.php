<?php

use yii\db\Migration;

/**
 * Class m200510_072808_admin_rule
 */
class m200510_072808_admin_rule extends Migration
{
    private $table = 'admin_rule';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $title = '文章内容RRR!!!';
        $this->insert($this->table, [
            'pid'       => 0,
            'title'     => $title,
            'route'     => null,
            'type'      => 1,
            'is_show'   => 1,
            'status'    => 1
        ]);
        $r = $this->db->createCommand("select * from admin_rule where title = '$title'")->bindValues($params)->queryOne();
        $this->update($this->table, ['title' => '文章内容'], ['id' => $r['id']]);

        $this->insert($this->table, [
            'pid'       => $r['id'],
            'title'     => '分类管理',
            'route'     => 'article/category/index',
            'type'      => 1,
            'is_show'   => 1,
            'status'    => 1
        ]);

        $this->insert($this->table, [
            'pid'       => $r['id'],
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
