<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "video_like".
 *
 * @property int $id
 * @property string $video_id
 * @property int $user_id
 * @property int $type
 * @property int|null $created_at
 *
 * @property User $user
 * @property Videos $video
 */
class VideoLike extends \yii\db\ActiveRecord
{

    const TYPE_LIKE = 1;
    const TYPE_DISLIKE = 0;

    public static function tableName()
    {
        return 'video_like';
    }

    public function rules()
    {
        return [
            [['video_id', 'user_id', 'type'], 'required'],
            [['user_id', 'type', 'created_at'], 'integer'],
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
            'type' => 'Type',
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
        return new \common\models\query\VideoLikeQuery(get_called_class());
    }
}
