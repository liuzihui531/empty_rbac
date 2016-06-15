<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminController
 *
 * @author Dell
 */
class AdminController extends AdminBaseController {

    public $page_name = "管理员";

    //put your code here
    public function actionIndex() {
        $this->breadcrumbs = array($this->page_name . '管理');
        $data = Admin::model()->getList();
        $this->render('index', $data);
    }

    public function actionCreate() {
        $this->breadcrumbs = array('添加' . $this->page_name);
        $model = new Admin();
        $model->username = ' ';
        $this->render('_form', array('model' => $model));
    }

    public function actionUpdate() {
        $this->breadcrumbs = array('修改' . $this->page_name);
        $id = Yii::app()->request->getParam('id', 0);
        $model = Admin::model()->findByPk($id);
        $this->checkEmpty($model);
        $model->password = '';
        $this->render('_form', array('model' => $model));
    }

    private function _save() {
        $id = Yii::app()->request->getParam('id', 0);
        $post = Yii::app()->request->getPost('Admin');
        try {
            if ($id) {
                $model = Admin::model()->findByPk($id);
                $model->setScenario('create');
                if(isset($post['password']) && $post['password']){
                    $model->password = Utils::password(trim($post['password']));
                }
            } else {
                $model = new Admin('create');
                $model->created = time();
                $model->username = trim($post['username']);
                $model->create_by = Yii::app()->user->name;
                $model->password = Utils::password(trim($post['password']));
            }            
            $model->role_id = $post['role_id'];
            $model->realname = $post['realname'];
            $model->remark = $post['remark'];
            $model->save();
            if ($model->hasErrors()) {
                throw new Exception(Utils::getFirstError($model->errors));
            }
            $this->handleResult(1, '操作成功', $this->createUrl('index'));
        } catch (Exception $ex) {
            $this->handleResult(0, '操作失败,原因:' . $ex->getMessage());
        }
    }

    public function actionDelete() {
        $id = Yii::app()->request->getParam('id', '');
        $id = (array) $id;
        $criteria = new CDbCriteria();
        $criteria->addInCondition('id', $id);
        $res = Admin::model()->deleteAll($criteria);
        if ($res) {
            $this->handleResult(1, '操作成功');
        } else {
            $this->handleResult(0, '操作失败');
        }
    }

    public function actionCreateSave() {
        $this->_save();
    }

    public function actionUpdateSave() {
        $this->_save();
    }

}
