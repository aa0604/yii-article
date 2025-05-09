<?php

use yii\db\Migration;

/**
 * Class m200312_021840_article
 */
class m200312_021840_article extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB comment ""';
        }
        $this->createTable('article', [
            'articleId'     => $this->primaryKey()->notNull()->comment('主键自增id'),
            'categoryId'     => $this->integer(11)->notNull()->comment('栏目'),
            'type'     => $this->smallInteger(3)->comment('文章类型'),
            'title'     => $this->string(300)->notNull()->comment('标题'),
            'keywords'     => $this->string(100)->comment('关键词'),
            'description'     => $this->string(500)->comment('描述'),
            'status' => $this->tinyInteger(1)->defaultValue(1)->comment('状态'),
            'voteUp' => $this->integer(11)->defaultValue(0)->comment('赞数量'),
            'sorting'     => $this->integer(6)->comment('排序'),
            'model'     => $this->string(30)->comment('文章模型（继承相应栏目）'),
            'allowComment'     => $this->tinyInteger(1)->comment('是否允许评论'),
            'commentNumber'     => $this->integer(1)->comment('评论数量'),
            'recommendId'       => $this->integer(11)->comment('推荐位'),
            'url'     => $this->string(500)->comment('指定链接'),
            'thumbnail'     => $this->string(200)->comment('缩略图'),
            'createTime'     => $this->datetime()->comment('创建时间'),
            'updateTime'     => $this->datetime()->comment('修改时间'),
            'template'     => $this->string(2000)->comment('使用模板'),
            'field1'     => $this->string(500)->comment('预留字段1'),
            'field2'     => $this->string(500)->comment('预留字段2'),
            'field3'     => $this->string(500)->comment('预留字段3'),
        ], $tableOptions);
        


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200312_021840_article cannot be reverted.\n";
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
        echo "m200312_021840_article cannot be reverted.\n";

        return false;
    }
    */
}
