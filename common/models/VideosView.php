<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "videos_view".
 *
 * @property int $id
 * @property string $video_id
 * @property int|null $user_id
 * @property int|null $created_at
 *
 * @property Users $user
 * @property Videos $video
 */
class VideosView extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'videos_view';
    }

    public function rules()
    {
        return [
            [['video_id'], 'required'],
            [['user_id', 'created_at'], 'integer'],
            [['video_id'], 'string', 'max' => 16],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['video_id'], 'exist', 'skipOnError' => true, 'targetClass' => Videos::className(), 'targetAttribute' => ['video_id' => 'video_id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'video_id' => 'Video ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getVideo()
    {
        return $this->hasOne(Videos::className(), ['video_id' => 'video_id']);
    }

    public static function find()
    {
        return new \common\models\query\VideosViewQuery(get_called_class());
    }
}
