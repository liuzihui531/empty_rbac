<?php

/**
 * This is the model class for table "rbac_role".
 *
 * The followings are the available columns in table 'rbac_role':
 * @property integer $id
 * @property string $role_name
 * @property string $role_desc
 * @property string $token
 * @property string $permission
 * @property integer $status
 * @property integer $created
 */
class RbacRole extends CActiveRecord {

    /**
     * 获取角色列表
     * @param type $platform
     * @param type $show_page
     * @param type $pageSize
     * @return type
     */
    public function getList($platform = 'admin', $show_page = true, $pageSize = 10) {
        $criteria = new CDbCriteria();
        //搜索项
        $title = Yii::app()->request->getParam('role_name', '');
        if ($title) {
            $criteria->addSearchCondition('role_name', $title);
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
    
    public function getKv(){
        $model = Yii::app()->db->createCommand("select id,role_name from rbac_role")->query();
        $list_data = CHtml::listData($model, 'id', 'role_name');
        return $list_data;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'rbac_role';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('status, created', 'numerical', 'integerOnly' => true),
            array('role_name', 'length', 'max' => 32),
            array('role_desc', 'length', 'max' => 64),
            array('token', 'length', 'max' => 108),
            array('permission', 'safe'),
            array('role_name','required'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, role_name, role_desc, token, permission, status, created', 'safe', 'on' => 'search'),
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
            'role_name' => '角色名称',
            'role_desc' => '角色描述',
            'token' => '令牌',
            'permission' => '权限,menu_id用逗号隔开',
            'status' => '状态 （1 正常 ，2 删除）',
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
        $criteria->compare('role_name', $this->role_name, true);
        $criteria->compare('role_desc', $this->role_desc, true);
        $criteria->compare('token', $this->token, true);
        $criteria->compare('permission', $this->permission, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('created', $this->created);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RbacRole the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
