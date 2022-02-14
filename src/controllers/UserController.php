<?php

namespace huzhenghui\yii\bootstrap4\user\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

use huzhenghui\yii\bootstrap4\user\models\LoginForm;

class UserController extends Controller
{
    public function init()
    {
        parent::init();
        foreach (Yii::$app->getModules(true) as $module) {
            if ($module instanceof \huzhenghui\yii\bootstrap4\starter\Module) {
                $this->layout = $module->getLayout();
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ]
            ]
        ];
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        $model->password = '';
        return $this->render('login', [
            'model' => $model
        ]);
    }

    /**
     * @return Response
     */
    public  function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
