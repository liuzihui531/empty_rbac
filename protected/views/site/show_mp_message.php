<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title>跳转提示</title>
    </head>

    <body>

        <fieldset class="system-message">

            <legend><?php echo empty($vip) ? $title : '温馨提示'; ?></legend>

            <div style="text-align:left;padding-left:10px;height:75px;width:490px;  ">



                <?php if ($type == 1): ?>

                    <p class="success">恭喜^_^!~<?php echo($msg); ?></p>

                <?php else: ?>

                    <p class="error">
                        Sorry!~<?php echo($msg); ?>&nbsp;&nbsp;&nbsp;
                        <?php if (!empty($vip)): ?>
                            <?php if($vip != 'applying'):?>
                            <a href="<?php echo $this->createUrl('/mp/vipapply') ?>">前往开通vip</a>
                            <?php endif;?>
                            &nbsp;&nbsp;&nbsp;或者&nbsp;&nbsp;&nbsp;
                            <a href="<?php echo $jumpurl?>">返回</a>
                        <?php endif; ?>
                    </p>

                <?php endif; ?>

                <p class="detail"></p>



            </div>
            <?php if (empty($vip)): ?>
                <p class="jump">

                    页面自动 <a id="href" href="<?php echo($jumpurl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($wait); ?></b>

                </p>
            <?php endif; ?>
        </fieldset>
        <?php if (empty($vip)): ?>
            <script type="text/javascript">



                (function () {

                    var wait = document.getElementById('wait'), href = document.getElementById('href').href;

                    totaltime = parseInt(wait.innerHTML);

                    var interval = setInterval(function () {

                        var time = --totaltime;

                        wait.innerHTML = "" + time;

                        if (time === 0) {

                            location.href = href;

                            clearInterval(interval);

                        }
                        ;

                    }, 1000);

                })();



            </script>
        <?php endif; ?>
    </body>

</html>
