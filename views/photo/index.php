<?php
/* @var $this yii\web\View */
/* @var $searchModel app\forms\search\PhotoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List photo';
$this->params['breadcrumbs'][] = $this->title;

use app\entities\Photo;
use yii\grid\GridView;
use yii\helpers\Html; ?>
<div class="photo-index">
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'attribute' => 'image',
            'value' => function (Photo $model) {
                return Html::a(Html::img(\Yii::getAlias('@web') . '/uploads/thumb/' . $model->name), Yii::getAlias('@web') . '/uploads/' . $model->name, ['target' => '_blank']);
            },
            'format' => 'raw',
            'contentOptions' => ['style' => 'width: 100px'],
        ],
        'name',
        'created_at:datetime'
    ],
]); ?>

</div>
