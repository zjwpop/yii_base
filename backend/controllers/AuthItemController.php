<?php

namespace backend\controllers;

use backend\models\Auth;
use backend\controllers\base\AuthController;
use common\helpers\Message;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * AuthController implements the CRUD actions for Auth model.
 */
class AuthItemController extends AuthController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Auth::find()->where(['type' => 2]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Auth();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Message::setSuccessMsg('添加成功');
                return $this->redirect(['view', 'id' => $model->name]);
            } else {
                Message::setErrorMsg('添加失败');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Message::setSuccessMsg('修改成功');
                return $this->redirect(['view', 'id' => $model->name]);
            } else {
                Message::setErrorMsg('修改失败');
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->delete()) {
            Message::setSuccessMsg('删除成功');
        } else {
            Message::setErrorMsg('删除失败');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Auth model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Auth the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Auth::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
