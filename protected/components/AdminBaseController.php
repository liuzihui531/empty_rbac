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
class AdminBaseController extends Controller{
    
    public $menu_data = array();
    
    public function init() {
        parent::init();
        $this->menu_data = RbacMenu::model()->getUnlimitData();
        //Utils::printr($this->menu_data);
    }
    
    
    
    public function beforeAction($action) {
        parent::beforeAction($action);
        return true;
    }
}
