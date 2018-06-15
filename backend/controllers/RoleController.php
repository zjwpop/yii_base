<?php

namespace backend\controllers;

use backend\models\Auth;
use backend\controllers\base\AuthController;
use common\helpers\Message;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rbac\DbManager;
use yii\web\NotFoundHttpException;

/**
 * RoleController implements the CRUD actions for Role model.
 */
class RoleController extends AuthController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Auth::find()->where(['type' => 1]),
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

    public function actionPermission($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if ($request->isPost) {
            $auth = Yii::$app->authManager;
            $role = $auth->createRole($model->name);

            $auth_db = new DbManager();
            $auth_db->removeChildren($role);

            $authData = $request->post('auth');
            if ($authData && is_array($authData)) {
                foreach ($authData as $item) {
                    $child = $auth->createPermission($item);
                    $auth_db->addChild($role, $child);
                }
            }

            $model->load($request->post());
            if ($model->save()) {
                Message::setSuccessMsg('授权成功');
                return $this->redirect(['view', 'id' => $model->name]);
            } else {
                Message::setErrorMsg('授权失败');
            }
        }

        return $this->render('permission', [
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

	public function actionList($role){

		$auth_db = new DbManager();
		$auth_db->init();
		$items = $auth_db->getPermissionsByRole($role);

		$tmp=Auth::find()->asArray()->where(['type' => 2])->orderBy(['name'=>SORT_ASC])->all();

		$data=[];
		foreach($tmp as $power){
			$pname=substr($power['name'],1);
			list($ctrl,$act)=explode('/',$pname);
			if(!array_key_exists($ctrl,$data)){
				$data[$ctrl]=[];
			}
			$data[$ctrl][]=['name'=>$power['description'],'route'=>$power['name']];
		}



		return $this->render('list', [
			'role'=>$role,
			'items'=>$items,
            'data' => $data,
        ]);

	}
	public function actionListDo(){
		$request = Yii::$app->request;
		$role_name=$request->post('role');
		$authData=$request->post('prem');
		//var_dump($authData);

		$auth = Yii::$app->authManager;
        $role = $auth->createRole($role_name);
		$auth_db = new DbManager();
		$auth_db->removeChildren($role);

		if ($authData && is_array($authData)) {
			foreach ($authData as $item) {
				$child = $auth->createPermission($item);
				$auth_db->addChild($role, $child);
			}
		}

		return $this->redirect(['index']);
		//return $this->redirect(['list','role'=>$role_name]);
	}



    /**
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Role the loaded model
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
