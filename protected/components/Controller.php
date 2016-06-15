<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();
    public $is_ueditor = false; //如果这个控制器有用到编辑器，则为true
    public $is_upload = false; //如果这个控制器有用到上传图片，则为true
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    public $seo_title = '';
    public $seo_keyword = '';
    public $seo_description = '';

    public function init() {
        parent::init();
    }

    public function handleResult($sta, $msg = '', $url = '', $data = array()) {
        $url = $url ? $url : Yii::app()->request->urlReferrer;
        $status = $sta > 0 ? "success" : "danger";
        if (Yii::app()->request->isAjaxRequest) {
            if ($sta == 1) {
                Yii::app()->user->setFlash($status, $msg);
            }
            $return = array(
                'sta' => $sta,
                'msg' => $msg,
                'url' => $url,
                'data' => $data,
            );
            die(CJSON::encode($return));
        } else {
            Yii::app()->user->setFlash($status, $msg);
            $this->redirect($url);
        }
    }

    public function checkEmpty($model) {
        if (!$model) {
            $this->handleResult(0, '数据为空', Yii::app()->request->urlReferrer);
        }
    }

    /**
     * 成功提示
     * @param type $msg 提示信息
     * @param type $jumpurl 跳转url
     * @param type $wait 等待时间
     */
    public function success($msg = "", $jumpurl = "", $wait = 1) {
        self::_jump($msg, $jumpurl, $wait, 1);
        exit;
    }

    public function jsonSuccess($msg = "", $jumpurl = "", $wait = 1) {
        if ($jumpurl === "") {
            $jumpurl = $_SERVER['HTTP_REFERER'];
        }
        echo $this->jsonHandle(1, $msg, $jumpurl, $wait);
        exit;
    }

    public function jsonError($msg = "", $jumpurl = "", $wait = 3) {
        echo $this->jsonHandle(0, $msg, $jumpurl, $wait);
        exit;
    }

    function jsonHandle($status, $message, $jumpurl = "", $wait = 3) {
        return CJSON::encode(array(
                    'status' => $status, 'message' => $message, 'jumpurl' => $jumpurl, 'wait' => $wait));
    }

    /**
     * 错误提示
     * @param type $msg 提示信息
     * @param type $jumpurl 跳转url
     * @param type $wait 等待时间
     * @param type $vip 是否提示需要开通vip
     */
    public function error($msg = "", $jumpurl = "", $wait = 3, $vip = '') {
        self::_jump($msg, $jumpurl, $wait, 0, $vip);
        exit;
    }

    /**
     * 最终跳转处理
     * @param type $msg 提示信息
     * @param type $jumpurl 跳转url
     * @param type $wait 等待时间
     * @param int $type 消息类型 0或1
     * @param type $vip 是否提示需要开通vip
     */
    static private function _jump($msg = "", $jumpurl = "", $wait = 1, $type = 0, $vip = '') {
        $info = array('msg' => $msg,
            'jumpurl' => $jumpurl,
            'wait' => $wait,
            'type' => $type,
            'vip' => $vip
        );

        Yii::app()->user->setFlash('showmessage', $info);
        Yii::app()->runController("Site/ShowMessage");
    }

}
