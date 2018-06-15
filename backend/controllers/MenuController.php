<?php
namespace backend\controllers;

use Yii;
use backend\controllers\base\AuthController;
use backend\models\AdminMenu;
use common\helpers\Message;

/**
 * Site controller
 */
class MenuController extends AuthController {
	public function actionIndex()
    {

        $searchModel = new AdminMenu();
        $params=Yii::$app->request->queryParams;
        // if(empty($params)){
        //     return $this->redirect(['index','AdminMenu[pid]'=>0]);
        // }

        $dataProvider = $searchModel->search($params);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate($pid=0)
    {
        $model = new AdminMenu();
        $model -> pid =$pid;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Message::setSuccessMsg('添加成功');
                return $this->redirect(['index', 'id' => $model->id]);
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
                return $this->redirect(['index', 'id' => $model->id]);
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

    protected function findModel($id)
    {
        if (($model = AdminMenu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
