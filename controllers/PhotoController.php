<?php

namespace app\controllers;

use app\forms\search\PhotoSearch;
use app\forms\UploadForm;
use app\services\PhotoService;
use Yii;
use yii\web\Controller;

class PhotoController extends Controller
{
    private PhotoService $service;

    public function __construct($id, $module, PhotoService $uploadService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $uploadService;
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new PhotoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpload()
    {
        $uploadForm = new UploadForm();

        if ($uploadForm->load(Yii::$app->request->post()) && $uploadForm->validate()) {
            try {
                $this->service->addPhotos($uploadForm);
                Yii::$app->session->setFlash('success', 'Successful');
                return $this->redirect(['upload']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('upload', ['model' => $uploadForm]);
    }
}
