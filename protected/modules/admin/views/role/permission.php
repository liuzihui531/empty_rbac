<style type="text/css">
    .table-permission{width:1000px;}
    .table-permission ul li{list-style: none;float:left}
    .table-permission tr td{border-bottom: 1px solid #ccc}
    .table-permission tr td.top{width:100px}
    .thead{padding:15px 0px;font-size: 18px;}
</style>
<div class="row">
    <form method="post" id='id-form'>
        <div class="">
            <div class="control-group ">
                <table class="table-permission">
                    <tr><td colspan="2" align="center" class="thead"><?php echo $model->role_name; ?></td></tr>
                    <?php foreach ($menu_data as $k => $v): ?>
                        <tr>
                            <td class="top">
                                <div class="checkbox">
                                    <label>
                                        <input value="<?php echo $v['id'] ?>" name="permission[]" class="ace ace-checkbox-2" <?php echo in_array($v['id'], $permission_data) ? "checked='checked'" : ''; ?> data-type='permission-top' type="checkbox">
                                        <span class="lbl"> <?php echo $v['title'] ?></span>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <?php if (isset($v['sub']) && $v['sub']): ?>
                                    <ul class="clearfix">
                                        <?php foreach ($v['sub'] as $kk => $vv): ?>
                                            <li>
                                                <div class="checkbox">
                                                    <label>
                                                        <input value="<?php echo $vv['id'] ?>" <?php echo in_array($vv['id'], $permission_data) ? "checked='checked'" : ''; ?> name="permission[]" data-type='permission-sub' class="ace ace-checkbox-2" type="checkbox">
                                                        <span class="lbl"> <?php echo $vv['title'] ?></span>
                                                    </label>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
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
    </form>
</div>
<script type="text/javascript">
    $("*[data-type='permission-top']").bind("change", function () {
        $(this).parents('tr').find('td ul').find("*[data-type='permission-sub']").prop("checked", $(this).prop('checked'));
    });
    $("*[data-type='permission-sub']").bind("change", function () {
        var is_checked = false;
        $(this).parents('tr').find('td ul').find("*[data-type='permission-sub']").each(function (k, v) {
            if ($(v).prop("checked")) {
                is_checked = true;
                return;
            }
        });
        $(this).parents('tr').find('td').find("*[data-type='permission-top']").prop("checked", is_checked);
    });
</script>


