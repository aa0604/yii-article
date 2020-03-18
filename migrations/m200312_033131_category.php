<?php

use yii\db\Migration;

/**
 * Class m200312_033131_category
 */
class m200312_033131_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB comment "文章栏目"';
        }
        $this->createTable('article_category', [
            'categoryId'     => $this->primaryKey()->notNull()->comment('栏目id'),
            'name'     => $this->string(300)->notNull()->comment('栏目名称'),
            'parentId'     => $this->integer(10)->notNull()->comment('栏目上级id'),
            'dir'     => $this->char(20)->notNull()->comment('栏目路径，只能是英文下划数字'),
            'categoryTemplate'     => $this->string(200)->notNull()->comment('使用模板'),
            'articleTemplate'     => $this->string(200)->notNull()->comment('文章模板'),
            'model'     => $this->string(30)->comment('文章模型'),
            'childrenIds'     => $this->string(10000)->notNull()->comment('子id'),
            'url'     => $this->string(500)->comment('指定链接'),
            'image'     => $this->string(200)->notNull()->comment('栏目图片'),
            'display'     => $this->integer(1)->notNull()->comment('是否显示'),
            'sorting'     => $this->integer(6)->notNull()->comment('排序，降序'),
            'createTime'     => $this->integer(10)->notNull()->comment('创建时间'),
            'updateTime'     => $this->integer(10)->notNull()->comment('修改时间'),
        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200312_033131_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200312_033131_category cannot be reverted.\n";

        return false;
    }
    */
}
