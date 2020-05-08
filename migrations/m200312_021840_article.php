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
            'type'     => $this->integer(3)->comment('文章类型'),
            'title'     => $this->string(300)->notNull()->comment('标题'),
            'keywords'     => $this->string(100)->comment('关键词'),
            'description'     => $this->string(500)->comment('描述'),
            'status' => $this->integer(1)->defaultValue(1)->comment('状态'),
            'voteUp' => $this->integer(11)->defaultValue(0)->comment('赞数量'),
            'sorting'     => $this->integer(6)->comment('排序'),
            'model'     => $this->string(30)->comment('文章模型（继承相应栏目）'),
            'allowComment'     => $this->integer(1)->comment('是否允许评论'),
            'commentNumber'     => $this->integer(1)->comment('评论数量'),
            'url'     => $this->string(500)->notNull()->comment('指定链接'),
            'thumbnail'     => $this->string(200)->comment('缩略图'),
            'createTime'     => $this->datetime()->comment('创建时间'),
            'updateTime'     => $this->datetime()->comment('修改时间'),
            'template'     => $this->string(2000)->notNull()->comment('使用模板'),
        ], $tableOptions);

        $this->addForeignKey("article_ibfk_1", "article", "categoryId", "article_category", "categoryId", "SET NULL", "CASCADE");
        $this->addForeignKey("article_ibfk_2", "article", "recommendId", "article_recommend", "recommendId", "SET NULL", "CASCADE");

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
