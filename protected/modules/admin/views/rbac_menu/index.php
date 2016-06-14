<div class="row">
    <div class="col-xs-12">
        <div class="table-responsive">
            <!--搜索框开始-->
            <div class="widget-box">
                <div class="widget-header">
                    <h4>搜索框</h4>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <form class="form-inline" method="get">
                            <input type="text" name="title" value="<?php echo Yii::app()->request->getParam('title', '') ?>" class="input-medium" placeholder="标题">
                            <button type="submit" class="btn btn-purple btn-sm">
                                搜索
                                <i class="icon-search icon-on-right bigger-110"></i>
                            </button>
                            <a href="<?php echo $this->createUrl('create') ?>" class="btn btn-primary btn-sm">添加</a>
                        </form>
                    </div>
                </div>
            </div>
            <!--搜索框结束-->
            <?php if ($unlimit_data): ?>
                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>菜单名称</th>
                            <th>菜单链接</th>
                            <th>菜单状态</th>
                            <th>菜单排序</th>
                            <th>操作</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($unlimit_data as $k => $v): ?>
                            <tr>
                                <td><?php if($v['level'] > 1): ?><?php echo $v['html'] ?>┗━<?php endif; ?><?php echo $v['title'] ?></td>
                                <td><?php echo $v['controller_action'] ?></td>
                                <td><?php echo $show_data[$v['is_show']] ?></td>
                                <td><?php echo $v['sorting'] ?></td>
                                <td>
                                    <a href="<?php echo $this->createUrl('update', array('id' => $v['id'])) ?>">修改</a>
                                    <a href="javascript:void(0)" class="delete-single" data-url="<?php echo $this->createUrl('delete', array('id' => $v['id'])) ?>">删除</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="no-record">
                    暂无数据
                </div>
            <?php endif; ?>
        </div><!-- /.table-responsive -->
    </div><!-- /span -->
</div><!-- /row -->