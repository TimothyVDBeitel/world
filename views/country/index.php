<?php

use app\models\Country;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CountrySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Countries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Country', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [


            // 'Code',
            [ 
                'label' => 'Name',
                'attribute' => "Name",
                // 'contentOptions' => ['style' => 'font-weight:bold;'],
            ],
            [
            'label' => 'continent',
            'attribute'=>'Continent',
            // 'contentOptions' => ['style' => 'font-weight:bold;'],
            ],

            [ 
                'label' => 'Hoofdstad',
                'attribute' => 'Capital',
                'format' => 'raw',
                'contentOptions' => [
                    'style' => 'width:20px; white-space: normal;'],
                    'value' => function($data) {
                    return Html::a('naar hoofdstad',['/city/index', 'CitySearch[ID]'=>$data->Capital]);
                }
            ],            
            [ 
                'label' => 'population',
                'attribute' => 'Population',
                'contentOptions' => [
                    'style' => 'width:30px; white-space: normal;'
                ],
            ],
            // [
            //     'label' => 'Oppervlakte',
            //     'attribute' => 'SurfaceArea',
            //     'format' => 'raw',
            //     'value' => 
            //         function($data) {
            //             return sprintf("%8d k&#13217", $data->SurfaceArea);
            //         }
            // ],
            [ 
                'label' => 'Bevolkingsdichtheid Timothy',
                'attribute' => "PopulationDensity",
                'contentOptions' => ['style' => 'width:30px; white-space: normal; color:red; font-weight:bold;'],
                'format' => 'raw',
                'value' => 
                function($data) {
                    $populationDensity = $data->Population / $data->SurfaceArea;
                
                    return sprintf("%8s per k&#13217", number_format($populationDensity, 2));
                }
            ],

            //'Region',
            //'IndepYear',
            //'LifeExpectancy',
            //'GNP',
            //'GNPOld',
            //'LocalName',
            //'GovernmentForm',
            //'HeadOfState',

            //'Code2',
            
            [
                'class' => 'yii\grid\ActionColumn', 'template' => '{update}  {delete}',
            ],
            
        ],
    ]); ?>


</div>
