<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminBaseController
 *
 * @author Dell
 */
class AdminBaseController extends Controller {

    public $menu_data = array();
    public $permission = array();

    public function init() {
        parent::init();
        $this->menu_data = RbacMenu::model()->getUnlimitData();
        //Utils::printr($this->menu_data);
        $permision_str = Yii::app()->session['permission'];
        if ($permision_str) {
            $this->permission = explode(",", $permision_str);
        }
        if (Yii::app()->user->name == 'admin') {
            $this->permission = array_keys($this->menu_data['unlimit_data']);
        }
    }

    public function beforeAction($action) {
        parent::beforeAction($action);
        //两个特殊点：1.index/index不需要任何权限，2. admin超级管理员不需要指定权限，即哪里都有权限
        $key = $this->id . "/" . $action->id;
        if ($key !== 'index/index') {
            $unlimit_data = $this->menu_data['unlimit_data'];
            $controller_action_data = Utils::getSubColumnValueToParentKey($unlimit_data, 'controller_action');
            if (!key_exists($key, $controller_action_data)) {
                $this->rbacErrorOutput("此链接在“权限设置->菜单管理”中未开通");
            }
            $menu_id = $controller_action_data[$key]['id'];
            if (!in_array($menu_id, $this->permission)) {
                $this->rbacErrorOutput("无此权限");
            }
        }
        return true;
    }

    /**
     * 权限错误提示
     */
    private function rbacErrorOutput($msg) {
        if (Yii::app()->request->isAjaxRequest) {
            $this->handleResult(0, $msg);
        } else {
            $this->error($msg, $this->createUrl('/admin/index/index'));
        }
    }

    /**
     * 判断一个链接本人是否有权限
     * @param type $controller_action
     * @return boolean
     */
    public function checkPermission($controller_action) {
        if ($controller_action !== 'index/index') {
            $unlimit_data = $this->menu_data['unlimit_data'];
            $controller_action_data = Utils::getSubColumnValueToParentKey($unlimit_data, 'controller_action');
            if (!key_exists($controller_action, $controller_action_data)) {
                return false;
            }
            $menu_id = $controller_action_data[$controller_action]['id'];
            if (!in_array($menu_id, $this->permission)) {
                return false;
            }
        }
        return true;
    }

}
