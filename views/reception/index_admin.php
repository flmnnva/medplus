<?php

use app\models\Reception;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\ReceptionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Receptions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reception-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Reception', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'patient_fio',
            'date_of_reception',
            'description:ntext',
            'user',
            [
                'attribute' => 'status',
                'content' => function ($report) {
                    $html = Html::beginForm(['update', 'id' => $report->id]);
                    $html .= Html::activeDropDownList($report, 'status_id',
                        [
                            1 => 'Подтверждена',
                            2 => 'Отклонена'
                        ],
                        [
                            'prompt' => [
                                'text' => 'Новая',
                                'options' => [
                                    'style' => 'display:none'
                                ]
                            ]
                        ]
                    );
                    $html .= Html::submitButton('Подтвердить', ['class' => 'btn btn-link']);
                    $html .= Html::endForm();
                    return $html;
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
