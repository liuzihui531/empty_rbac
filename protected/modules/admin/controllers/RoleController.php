<?php

/**
 * Description of RoleController
 *
 * @author Dell
 */
class RoleController extends AdminBaseController {

    public $page_name = "角色";

    //put your code here
    public function actionIndex() {
        $this->breadcrumbs = array($this->page_name . '管理');
        $data = RbacRole::model()->getList();
        $this->render('index', $data);
    }

    public function actionCreate() {
        $this->breadcrumbs = array('添加' . $this->page_name);
        $model = new RbacRole();
        $this->render('_form', array('model' => $model));
    }

    public function actionUpdate() {
        $this->breadcrumbs = array('修改' . $this->page_name);
        $id = Yii::app()->request->getParam('id', 0);
        $model = RbacRole::model()->findByPk($id);
        $this->checkEmpty($model);
        $this->render('_form', array('model' => $model));
    }

    private function _save() {
        $id = Yii::app()->request->getParam('id', 0);
        if ($id) {
            $model = RbacRole::model()->findByPk($id);
        } else {
            $model = new RbacRole();
            $model->created = time();
        }
        try {
            $model->attributes = Yii::app()->request->getPost('RbacRole');
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
        $criteria2 = new CDbCriteria();
        $criteria2->addInCondition("role_id", $id);
        if(Admin::model()->find($criteria2)){
            $this->handleResult(0, '操作失败，有管理员属于此角色');
        }
        $criteria = new CDbCriteria();
        $criteria->addInCondition('id', $id);
        $res = RbacRole::model()->deleteAll($criteria);
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
    
    /**
     * 编辑权限
     */
    public function actionPermission($id){
        $this->breadcrumbs = array($this->page_name . '权限编辑');
        $model = RbacRole::model()->findByPk($id);
        $unlimit_data = $this->menu_data['unlimit_data'];
        $menu_data = array();
        foreach ($unlimit_data as $k=>$v){
            if($v['pid'] == 0){
                $menu_data[$v['id']] = $v;
            }else{
                $menu_data[$v['top_id']]['sub'][$v['id']] = $v;
            }
        }
        $this->render('permission',array('model'=>$model,'menu_data' => $menu_data));
    }

}
