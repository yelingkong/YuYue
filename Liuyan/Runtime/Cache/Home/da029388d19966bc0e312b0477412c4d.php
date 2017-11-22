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
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
    <div class="layui-logo">预约留言管理系统</div>
    <ul class="layui-nav layui-layout-right">
        <li class="layui-nav-item">
            <a href="javascript:;">
          <img src="http://t.cn/RCzsdCq" class="layui-nav-img"><?php echo getLoginUsername()?></a>
        </li>
        <li class="layui-nav-item"><a href="javascript:;" onclick="tui()">注销</a></li>
    </ul>
</div>
<script>
function tui() {
    layui.use('layer', function() {
        var layer = layui.layer;
        layer.confirm('确定要退出吗', { icon: 3, title: '提示' }, function(index) {
            window.location.href = "/liuyan.php?c=login&a=loginout";
            layer.close(index);
        });
    });
}
</script>
        <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <ul class="layui-nav layui-nav-tree" lay-filter="test">
            <li class="layui-nav-item layui-nav-itemed">
                <a class="javascript:;" href="javascript:;">后台菜单<span class="layui-nav-more"></span></a>
                <dl class="layui-nav-child">
                    <dd id="shouye">
                        <a href="/liuyan.php?c=index">首页</a>
                    </dd>
                    <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><dd id="hospital_<?php echo ($vo["hid"]); ?>">
                            <a href="/liuyan.php?c=index&a=liuyan&hospital=<?php echo ($vo["hid"]); ?>"><?php echo ($vo["hname"]); ?></a>
                        </dd><?php endforeach; endif; else: echo "" ;endif; ?>
                </dl>
            </li>
            <li class="layui-nav-item layui-nav-itemed">
                <a href="/liuyan.php?c=index&a=hospital">医院</a>
            </li>
            <li class="layui-nav-item layui-nav-itemed">
                <a href="/liuyan.php?c=index&a=logs">登录日志</a>
            </li>
        </ul>
    </div>
</div>
<script>
function GetQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]);
    return null;
}
hospital = GetQueryString("hospital");
if (hospital) {
    $("#hospital_" + hospital).addClass("layui-this");
} else { $("#shouye").addClass("layui-this"); }
</script>
        <div class="layui-body">
            <!-- 内容主体区域 -->
            <div style="padding: 15px;">
                <table id="demo" class="layui-table" lay-filter="demo"></table>
                <script type="text/html" id="barDemo">
                    <a class="layui-btn layui-btn-xs btnFtpEdit" data-id="{{d.hid}}" lay-filter="edit" lay-event="edit">编辑</a>
                </script>
            </div>
        </div>
    </div>
    <script>
    layui.use('table', function() {
        var addBoxIndex = -1;
        var table = layui.table,
            form = layui.form;
        table.render({
            elem: '#demo',
            url: '/liuyan.php?c=hospital',
            page: true,
            limit: 15,
            cols: [
                [
                    { field: 'hid', title: 'id', },
                    { field: 'hname', title: '医院名', },
                    { field: 'short_title', title: '短标识', },
                    { fixed: 'right', title: '操作', align: 'center', toolbar: '#barDemo' }
                ]
            ]
        });
        table.on('tool(demo)', function(obj) {
            if (obj.event === 'edit') {
                if (addBoxIndex !== -1) return;
                var id = $(this).attr("data-id");
                var url = "/liuyan.php?c=hospital&a=edit&hid=" + id;
                addBoxIndex = layer.open({
                    type: 2,
                    title: "医院编辑",
                    content: url,
                    shade: false,
                    area: ['560px', '435px'],
                    zIndex: 200000,
                    end: function() {
                        addBoxIndex = -1;
                    }
                });
            }
        });
    });
    </script>
    <script src='/Public/js/liuyan.js'></script>
</body>

</html>