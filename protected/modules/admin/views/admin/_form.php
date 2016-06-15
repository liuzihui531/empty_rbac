<style type="text/css">
</style>
<?php
$action = $this->action->id;
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'id-form',
    'action' => $this->createUrl($action . 'Save'),
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role' => 'form',
    ),
        ));
?>
<?php if ($model->id): ?>
    <input type="hidden" name="id" value="<?php echo $model->id ?>" />
<?php endif; ?>
<div class="form-group">
    <?php echo $form->labelEx($model, 'username', array('class' => 'col-sm-3 control-label no-padding-right')) ?>
    
    <div class="col-sm-9">
        <?php if($model->id): ?>
        <div style="padding: 5px 4px;line-height: 1.2;"><?php echo $model->username ?></div>
        <?php else: ?>
        <?php echo $form->textField($model, 'username', array('autocomplete' => 'off', 'class' => 'col-xs-10 col-sm-5', 'placeholder' => '')) ?>
        <?php endif; ?>
    </div>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model, 'password', array('class' => 'col-sm-3 control-label no-padding-right')) ?>

    <div class="col-sm-9">
        <?php echo $form->passwordField($model, 'password', array('autocomplete' => 'off', 'class' => 'col-xs-10 col-sm-5', 'placeholder' => '')) ?>
    </div>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model, 'role_id', array('class' => 'col-sm-3 control-label no-padding-right')) ?>

    <div class="col-sm-9">
        <?php echo $form->dropDownList($model, 'role_id', RbacRole::model()->getKv(), array('class' => 'col-xs-10 col-sm-5', 'placeholder' => '', 'prompt' => '--请选择角色--')) ?>
    </div>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model, 'realname', array('class' => 'col-sm-3 control-label no-padding-right')) ?>

    <div class="col-sm-9">
        <?php echo $form->textField($model, 'realname', array('autocomplete' => 'off', 'class' => 'col-xs-10 col-sm-5', 'placeholder' => '')) ?>
    </div>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model, 'remark', array('class' => 'col-sm-3 control-label no-padding-right')) ?>

    <div class="col-sm-9">
        <?php echo $form->textarea($model, 'remark', array('autocomplete' => 'off', 'class' => 'col-xs-10 col-sm-5', 'placeholder' => '')) ?>
    </div>
</div>

<div class="clearfix form-actions">
    <div class="col-md-offset-3 col-md-9">
        <button class="btn btn-info" type="button" id="submit">
            <i class="icon-ok bigger-110"></i>
            提交
        </button>

        &nbsp; &nbsp; &nbsp;
        <button class="btn" type="reset">
            <i class="icon-undo bigger-110"></i>
            重置
        </button>
    </div>
</div>
<?php $this->endWidget(); ?>