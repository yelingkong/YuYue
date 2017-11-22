<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>医院管理</title>
    <link rel="stylesheet" href="/Public/layui/css/layui.css">
    <link rel="stylesheet" href="/Public/assets/css/admin.css">
    <script src="http://apps.bdimg.com/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="/Public/layui/layui.js"></script>
</head>

<body class="layui-layout-body">
    <div style="padding: 15px;">
        <div class="layui-row">
            <div class="layui-col-md12">
                <form class="layui-form" method="post">
                    <div class="layui-form-item">
                        <label class="layui-form-label">id</label>
                        <div class="layui-input-block">
                            <div class="layui-form-mid"><?php echo ($hid); ?></div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">医院名</label>
                        <div class="layui-input-inline">
                            <input type="text" name="hname" value="<?php echo ($hname); ?>" placeholder="0" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">医院标识</label>
                        <div class="layui-input-inline">
                            <input type="text" name="short_title" value="<?php echo ($short_title); ?>" placeholder="0" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item text-right">
                        <div class="layui-input-block">
                            <input type="hidden" name="id" value="<?php echo ($hid); ?>" />
                            <button class="layui-btn layui-btn-small" lay-submit lay-filter="formFtpEdit">提交</button>
                            <button type="reset" class="layui-btn layui-btn-normal layui-btn-small">重置</button>
                            <button class="layui-btn layui-btn-small" id="btnClose">关闭</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    layui.use('form', function() {
        var $ = layui.jquery;
        var addBoxIndex = -1;
        $("form").submit(function() {
            var url = location.href;
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.errCode == 0) {
                        layer.msg(data.msg, { icon: 1, time: 1000 }, function() {
                            parent.layer.closeAll();
                        });
                    } else if (data.errCode == 1) {
                        layer.msg(data.msg, { icon: 2, time: 1000 });
                    } else {
                        layer.msg("数据错误", { icon: 2, time: 1000 });
                    }
                },
                error: function(data) {
                    layer.msg("网络错误", { icon: 2, time: 1000 });
                }
            });
            return false;
        });
        $("#btnClose").click(function() {
            parent.layer.closeAll();
        });
    });
    </script>
</body>

</html>