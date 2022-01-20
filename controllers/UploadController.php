<?php

namespace app\controllers;

use app\models\UploadForm;
use app\services\UploadService;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

class UploadController extends Controller
{
    private $service;

    public function __construct($id, $module, UploadService $uploadService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $uploadService;
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUpload()
    {
        $photosForm = new UploadForm();

        if ($photosForm->load(Yii::$app->request->post()) && $photosForm->validate()) {
            try {
                $this->service->addPhotos($photosForm);
                Yii::$app->session->setFlash('success', 'LOL!');
                return $this->redirect(['upload']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('upload', ['model' => $photosForm]);
    }
}
