<style type="text/css">
    .control-group dl dt{float:left}
</style>
<?php echo $model->role_name; ?>
<div class="row">
    <div class="col-xs-12 col-sm-5">
        <div class="control-group">
            <?php foreach ($menu_data as $k => $v): ?>
                <dl>
                    <dt>
                        <div class="checkbox">
                            <label>
                                <input name="form-field-checkbox" class="ace ace-checkbox-2" type="checkbox">
                                <span class="lbl"> <?php echo $v['title'] ?></span>
                            </label>
                        </div>
                    </dt>
                    <?php if ($v['sub']): ?>
                        <?php foreach ($v['sub'] as $kk => $vv): ?>
                            <dd>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" class="ace ace-checkbox-2" type="checkbox">
                                        <span class="lbl"> <?php echo $vv['title'] ?></span>
                                    </label>
                                </div>
                            </dd>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </dl>
            <?php endforeach; ?>
        </div>
    </div>
</div>


