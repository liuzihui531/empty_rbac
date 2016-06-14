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
    <?php echo $form->labelEx($model, 'pid', array('class' => 'col-sm-3 control-label no-padding-right')) ?>
    <div class="col-sm-9">
        <select class="rcol-xs-10 col-sm-5" name="RbacMenu[pid]">
            <option value="0">作为一级菜单</option>
            <?php if ($unlimit_data): ?>
                <?php foreach ($unlimit_data as $k => $v): ?>
                    <option <?php if($model->id && $v['id'] == $model->pid): ?>selected='selected'<?php endif ?> value="<?php echo $v['id'] ?>"><?php if($v['level'] > 1): ?><?php echo $v['html'] ?>┗━<?php endif; ?><?php echo $v['title'] ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model, 'title', array('class' => 'col-sm-3 control-label no-padding-right')) ?>

    <div class="col-sm-9">
        <?php echo $form->textField($model, 'title', array('class' => 'col-xs-10 col-sm-5', 'placeholder' => '')) ?>
    </div>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model, 'controller_action', array('class' => 'col-sm-3 control-label no-padding-right')) ?>

    <div class="col-sm-9">
        <?php echo $form->textField($model, 'controller_action', array('class' => 'col-xs-10 col-sm-4', 'placeholder' => '')) ?>
        &nbsp;1级菜单可以填“#”
    </div>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model, 'sorting', array('class' => 'col-sm-3 control-label no-padding-right')) ?>

    <div class="col-sm-9">
        <?php echo $form->textField($model, 'sorting', array('class' => 'col-xs-10 col-sm-5', 'placeholder' => '')) ?>
    </div>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model, 'is_show', array('class' => 'col-sm-3 control-label no-padding-right')) ?>
    &nbsp;
    <label>
        <?php echo $form->checkBox($model, 'is_show', array('class' => 'ace ace-switch ace-switch-5')) ?>
        <span class="lbl"></span>
    </label>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model, 'menu_desc', array('class' => 'col-sm-3 control-label no-padding-right')) ?>

    <div class="col-sm-9">
        <?php echo $form->textarea($model, 'menu_desc', array('class' => 'col-xs-10 col-sm-5', 'placeholder' => '')) ?>
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