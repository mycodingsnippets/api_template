<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%videos_view}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%videos}}`
 * - `{{%users}}`
 */
class m200603_043726_create_videos_view_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%videos_view}}', [
            'id' => $this->primaryKey(),
            'video_id' => $this->string(16)->notNull(),
            'user_id' => $this->integer(11),
            'created_at' => $this->integer(11),
        ]);

        // creates index for column `video_id`
        $this->createIndex(
            '{{%idx-videos_view-video_id}}',
            '{{%videos_view}}',
            'video_id'
        );

        // add foreign key for table `{{%videos}}`
        $this->addForeignKey(
            '{{%fk-videos_view-video_id}}',
            '{{%videos_view}}',
            'video_id',
            '{{%videos}}',
            'video_id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-videos_view-user_id}}',
            '{{%videos_view}}',
            'user_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-videos_view-user_id}}',
            '{{%videos_view}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%videos}}`
        $this->dropForeignKey(
            '{{%fk-videos_view-video_id}}',
            '{{%videos_view}}'
        );

        // drops index for column `video_id`
        $this->dropIndex(
            '{{%idx-videos_view-video_id}}',
            '{{%videos_view}}'
        );

        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-videos_view-user_id}}',
            '{{%videos_view}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-videos_view-user_id}}',
            '{{%videos_view}}'
        );

        $this->dropTable('{{%videos_view}}');
    }
}
