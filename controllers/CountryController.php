<?php

namespace app\controllers;

use app\models\Country;
use app\models\CountrySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CountryController implements the CRUD actions for Country model.
 */
class CountryController extends Controller
{
    public function actionHello() {
        echo "Hello World!";
        exit;
    }
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

// 
    /**
     * Lists all Country models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CountrySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Country model.
     * @param string $Code Code
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Code)
    {
        return $this->render('view', [
            'model' => $this->findModel($Code),
        ]);
    }

    /**
     * Creates a new Country model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Country();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'Code' => $model->Code]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Country model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $Code Code
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Code)
    {
        $model = $this->findModel($Code);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Code' => $model->Code]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Country model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Code Code
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Code)
    {
        $this->findModel($Code)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Country model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Code Code
     * @return Country the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Code)
    {
        if (($model = Country::findOne(['Code' => $Code])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionOverzicht()
    {
        // Timothy van den Beitel
        // De actionOverzicht voert een query uit en roept de view overzicht op,maar die view bestaat nog niet.
        // dit is de query, dit is te vergelijken met select * from Country
        $countries=Country::find()->all();
      
        // de view wordt aangeroepen en het object $countries en $pagination wordt meegegeven.
        return $this->render('overzicht', [
            'countries' => $countries,
        ]);
    }
    public function actionOverzichtEurope(){

        $countries = country::find()->where(['Continent' => 'Europe'])
        // ->andWhere(['<', 'SurfaceArea', 100000])
        ->orderBy(['SurfaceArea' => SORT_DESC])->all();
        return $this->render('overzicht', [
            'countries' => $countries,]);
    }
}

?>



