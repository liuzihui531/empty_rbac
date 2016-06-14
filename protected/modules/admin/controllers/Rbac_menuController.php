<?php

/**
 * 菜单控制器
 *
 * @author lzh
 */
class Rbac_menuController extends AdminBaseController {

    public $page_name = "菜单";

    public function actionIndex() {
        $this->breadcrumbs = array($this->page_name . '管理');
        $unlimit_data = RbacMenu::model()->getUnlimitData();
        $this->render('index', array('unlimit_data'=>$unlimit_data['unlimit_data'],'show_data'=>  ThisTools::getIsShow()));
    }

    public function actionCreate() {
        $this->breadcrumbs = array('添加' . $this->page_name);
        $unlimit_data = RbacMenu::model()->getUnlimitData();
        //Utils::printr($unlimit_data);
        $model = new RbacMenu();
        $this->render('_form', array('model' => $model,'unlimit_data'=>$unlimit_data['unlimit_data']));
    }

    public function actionUpdate() {
        $this->breadcrumbs = array('修改'.$this->page_name);
        $unlimit_data = RbacMenu::model()->getUnlimitData();
        $id = Yii::app()->request->getParam('id', 0);
        $model = RbacMenu::model()->findByPk($id);
        $this->checkEmpty($model);
       $this->render('_form', array('model' => $model,'unlimit_data'=>$unlimit_data['unlimit_data']));
    }

    public function actionDelete() {
        $id = Yii::app()->request->getParam('id','');
        $id = (array)$id;
        $criteria = new CDbCriteria();
        $criteria->addInCondition('id', $id);
        $res = RbacMenu::model()->deleteAll($criteria);
        if($res){
            RbacMenu::model()->setUnlimitData();//更新缓存
            $this->handleResult(1, '操作成功');
        }else{
            $this->handleResult(0, '操作失败');
        }
    }

    private function _save() {
        $id = Yii::app()->request->getParam('id', 0);
        if ($id) {
            $model = RbacMenu::model()->findByPk($id);
        } else {
            $model = new RbacMenu();
            $model->created = time();
        }
        try {
            $model->attributes = Yii::app()->request->getPost('RbacMenu');
            $model->save();
            if ($model->hasErrors()) {
                throw new Exception(Utils::getFirstError($model->errors));
            }
            RbacMenu::model()->setUnlimitData();//更新缓存
            $this->handleResult(1, '操作成功', $this->createUrl('index'));
        } catch (Exception $ex) {
            $this->handleResult(0, '操作失败,原因:' . $ex->getMessage());
        }
    }

    public function actionCreateSave() {
        $this->_save();
    }

    public function actionUpdateSave() {
        $this->_save();
    }

}
