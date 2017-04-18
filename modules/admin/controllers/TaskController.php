<?php

namespace app\modules\admin\controllers;

use app\components\FbComponent;
use app\models\Posts;
use app\models\User;
use app\models\Users;
use Yii;
use app\models\Task;
use app\models\TaskSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\db\Query;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['index',''],
                'rules' => [
                    [
                        //       'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function () {
                    return Yii::$app->response->redirect(['admin/default/login']);
                },
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Task();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /**
     * Post an existing Task model.
     * @param integer $id
     * @return mixed
     */


    public function actionPost($id)
    {
        /**
         * @var $post Posts
         * @var $user Users
         * @var $fb FbComponent
         *
         */
        $fb = Yii::$app->fb;
        $model = $this->findModel($id);
        // echo 'hello';
        ini_set('max_execution_time', 0);
        Yii::$app->db->createCommand()->update('posts', ['is_shared' => 'yes'], 'id in (' . $model->posts . ')')->execute();
        $query = (new Query())->select(['*'])->from('posts')->where(['id' => explode(",", $model->posts)]);
        $command = $query->createCommand();
        $data = $command->queryAll();

        $userQuery = "select * from `users`  WHERE id > $model->idnow ";
        if ($model->gander != 'both') {
            $userQuery .= " AND fb_gender='$model->gander' ";
        }
        if (substr($model->count, 0, 3) != "ALL") {
            $cn = "'" . str_replace(",", "','", $model->count) . "'";
            $userQuery .= " AND country_code IN ({$cn}) ";
        }
        $users = Users::findBySql($userQuery)->all();

        if (count($users) == 0) {
            throw new \yii\web\HttpException(400, 'The Task Already done.');


        } else {
            $model->totalcount = count($users);
            $model->update(false);
            $fb = Yii::$app->fb;
            foreach ($users as $user) {
                $post_postion = rand(0, count($data) - 1);

                $post = (object)$data[$post_postion];
                if ($post->type == "text") {
                    $appAccess =  $fb->fb->getApp()->getAccessToken();
                    $user_post = $fb->postMsg($user->fb_id, $post->text, $appAccess);
                    if ($user_post != 1)
                        $user_post = $fb->postMsg($user->fb_id, $post->text, $user->fb_access);
                } else if ($post->type == "link") {
                    $user_post = $fb->postLink($user->fb_id, $post->text, $post->link, $user->fb_access);
                } else {
                    $user_post = $fb->postImage($user->fb_id, $post->text, $post->link, $user->fb_access);
                }

                if ($user_post == 1) {
                    echo "<div class='success' style='padding:10px;margin:10px;background:green;color:white;'>POST DONE ".$user->fb_name."</div>";
                    $user->last_share = 0;
                    $model->successed++;
                } else {
                    echo "<div class='error' style='padding:10px;margin:10px;background:red;color:white;'>Cant Post ".$user->fb_name."  ".$user_post."</div>";
                    $user->last_share = 1;
                    $model->failed++;
                }
                if (($model->successed + $model->failed) >= $model->totalcount) {
                    $model->isfinish = 1;
                }
                $user->update(false);
                $model->idnow = $user->id;
                $model->update(false);
                flush();
                ob_flush();
            }
        }
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
