<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use app\models\Category;
use app\models\Job;

class JobController extends \yii\web\Controller{
    public function actionIndex(){
        // Create Query
        $query = Job::find();

        $pagination = new Pagination([
            'defaultPageSize' => 20,
            'totalCount' => $query->count(),
        ]);

        $jobs = $query->orderBy('create_date DESC')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        // Render View
        return $this->render('index', [
            'jobs' => $jobs,
            'pagination' => $pagination,
        ]);
    }

    public function actionDetails($id){
        // Get Job
        $job = Job::find()
            ->where(['id' => $id])
            ->one();

        // Render View
        return $this->render('details', ['job' => $job]);
    }

    public function actionCreate(){
        $foo = 'Bar';
        return $this->render('create', ['foo' => $foo]);
    }

    public function actionDelete(){
        return $this->render('delete');
    }

    public function actionEdit(){
        return $this->render('edit');
    }
}
