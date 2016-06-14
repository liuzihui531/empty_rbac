<?php

/**
 * This is the model class for table "rbac_menu".
 *
 * The followings are the available columns in table 'rbac_menu':
 * @property integer $id
 * @property string $title
 * @property string $controller_action
 * @property integer $pid
 * @property integer $sorting
 * @property string $menu_desc
 * @property integer $is_show
 * @property integer $created
 */
class RbacMenu extends CActiveRecord {

    public $cache_key = "menu_unlimit";

    /**
     * 获取列表
     * @param type $platform
     * @param type $show_page
     * @param type $pageSize
     * @return type
     */
    public function getList($platform = 'admin', $show_page = true, $pageSize = 10) {
        $criteria = new CDbCriteria();
        //搜索项
        $title = Yii::app()->request->getParam('title', '');
        if ($title) {
            $criteria->addSearchCondition('title', $title);
        }
        if ($platform == 'admin') {
            
        }
        $pager = new CPagination($this->count($criteria));
        if ($show_page) {
            $pager->pageSize = $pageSize;
            $pager->applyLimit($criteria);
        }
        $model = $this->findAll($criteria);
        return array('model' => $model, 'pager' => $pager);
    }

    /**
     * 取得带子项的无限极分类
     */
    public function getUnlimitData() {
        $data = Yii::app()->cache->get($this->cache_key);
        $data = false;
        if (!$data['unlimit_data']) {
            $data = $this->setUnlimitData();
        }
        return $data;
    }

    public function setUnlimitData() {
        $criteria = new CDbCriteria();
        $criteria->order = "sorting asc";
        $model = $this->findAll();
        $data = $this->getUnLimitClass($model);
        if ($data['unlimit_data']) {
            Yii::app()->cache->set($this->cache_key, $data);
        }
        return $data;
    }

    private function getUnLimitClass($model) {
        $unlimit_data = Utils::getUnLimitClass(Utils::object2array($model));
        $sub_limit = Utils::getSubUnlimit($model);
        foreach ($sub_limit as $k => $v) {
            $controller = array();
            if (isset($v['sub'])) {
                foreach ($v['sub'] as $kk => $vv) {
                    if (strstr($vv['controller_action'], "/")) {
                        $controller_action = explode("/", $vv['controller_action']);
                        $controller[] = $controller_action[0];
                        $v['sub'][$kk]['controller'] = $controller_action[0];
                        $v['sub'][$kk]['action'] = $controller_action[1];
                    }
                }
            } else {
                if (strstr($v['controller_action'], "/")) {
                    $controller_action = explode("/", $v['controller_action']);
                    $controller[] = $controller_action[0];
                    $v['controller'] = $controller_action[0];
                    $v['action'] = $controller_action[1];
                }
            }
            $v['controller_list'] = $controller;
            $sub_limit[$k] = $v; 
        }
        return array(
            'unlimit_data' => $unlimit_data,
            'sub_limit' => $sub_limit,
        );
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rbac_menu';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pid, sorting, is_show, created', 'numerical', 'integerOnly' => true),
            array('title, controller_action', 'length', 'max' => 32),
            array('menu_desc', 'length', 'max' => 512),
            array('title, controller_action', 'required'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, controller_action, pid, sorting, menu_desc, is_show, created', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => '菜单标题',
            'controller_action' => '链接',
            'pid' => '上级菜单',
            'sorting' => '排序',
            'menu_desc' => '描述',
            'is_show' => '显示状态',
            'created' => 'Created',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('controller_action', $this->controller_action, true);
        $criteria->compare('pid', $this->pid);
        $criteria->compare('sorting', $this->sorting);
        $criteria->compare('menu_desc', $this->menu_desc, true);
        $criteria->compare('is_show', $this->is_show);
        $criteria->compare('created', $this->created);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RbacMenu the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
