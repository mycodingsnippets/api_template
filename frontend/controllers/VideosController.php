<?php


namespace frontend\controllers;


use common\models\VideoLike;
use common\models\Videos;
use common\models\VideosView;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use function foo\func;

class VideosController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['like', 'dislike', 'history'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
            'verb' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'like' => ['post'],
                    'dislike' => ['post'],
                ]
            ]
        ];
    }

    public function actionIndex(){
        $dataProvider = new ActiveDataProvider([
            'query' => Videos::find()
                            ->with('createdBy')
                            ->published()
                            ->latest(),
            'pagination' => [
                'pageSize' => 2
            ]
        ]);
        return $this->render('index', [
            'dataProvider'=> $dataProvider
        ]);
    }

    public function actionView($id){
        $this->layout = 'auth';

        $video = $this->findVideo($id);

        $videoView = new VideosView();
        $videoView->video_id = $id;
        $videoView->user_id = \Yii::$app->user->id;
        $videoView->created_at = time();
        $videoView->save();

        $similarVideos = Videos::find()
                            ->published()
                            ->andWhere(['NOT', ['video_id' => $id]])
                            ->byKeyword($video->title)
                            ->limit(10)
                            ->all();

        return $this->render('view',[
            'model' => $video,
            'similarVideos' => $similarVideos
        ]);
    }

    public function actionLike($id){
        $video = $this->findVideo($id);
        $userId = \Yii::$app->user->id;

        $videoLikeDislike = VideoLike::find()
                        ->userIdVideoId($userId, $id)
                        ->one();

        if(!$videoLikeDislike) {
            $this->saveLikeDisklike($id, $userId, VideoLike::TYPE_LIKE);
        }elseif ($videoLikeDislike->type == VideoLike::TYPE_LIKE){
            $videoLikeDislike->delete();
        }else{
            $videoLikeDislike->delete();
            $this->saveLikeDisklike($id, $userId, VideoLike::TYPE_LIKE);
        }

        return $this->renderAjax('_buttons', [
            'model' => $video
        ]);
    }

    public function actionDislike($id){
        $video = $this->findVideo($id);
        $userId = \Yii::$app->user->id;

        $videoLikeDislike = VideoLike::find()
            ->userIdVideoId($userId, $id)
            ->one();

        if(!$videoLikeDislike) {
            $this->saveLikeDisklike($id, $userId, VideoLike::TYPE_DISLIKE);
        }elseif ($videoLikeDislike->type == VideoLike::TYPE_DISLIKE){
            $videoLikeDislike->delete();
        }else{
            $videoLikeDislike->delete();
            $this->saveLikeDisklike($id, $userId, VideoLike::TYPE_DISLIKE);
        }

        return $this->renderAjax('_buttons', [
            'model' => $video
        ]);
    }

    protected function findVideo($id){
        $video = Videos::findOne($id);

        if(!$video){
            throw new NotFoundHttpException('Video does not exist');
        }

        return $video;
    }

    protected function saveLikeDisklike($videoId, $userId, $type){
        $videoLikeDislike = new VideoLike();
        $videoLikeDislike->video_id = $videoId;
        $videoLikeDislike->user_id = $userId;
        $videoLikeDislike->type = $type;
        $videoLikeDislike->created_at = time();
        $videoLikeDislike->save();
    }

    public function actionSearch($keyword){

        $query = Videos::find()
            ->with('createdBy')
            ->published()
            ->latest();

        if($keyword){
            $query->byKeyword($keyword)
                   ->orderBy("MATCH(title, description, tags) AGAINST ('$keyword') DESC");
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('search', [
            'dataProvider'=> $dataProvider
        ]);
    }

    public function actionHistory(){
        $query = Videos::find()
                    ->alias('v')
                    ->innerJoin(
                        " (SELECT video_id, MAX(created_at) AS max_date FROM videos_view WHERE user_id=:user_id GROUP BY video_id) vv",
                        'vv.video_id = v.video_id',
                        ['user_id'=>\Yii::$app->user->id])
                    ->orderBy("vv.max_date DESC");


        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('history', [
            'dataProvider'=> $dataProvider
        ]);
    }
}