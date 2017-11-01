<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>预约留言管理系统</title>
    <link rel="stylesheet" href="/Public/layui/css/layui.css">
    <link rel="stylesheet" href="/Public/assets/css/admin.css">
    <script src="http://apps.bdimg.com/libs/jquery/1.9.0/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/assets/js/echarts.min.js"></script>
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
        <li class="layui-nav-item"><a href="/liuyan.php?c=login&a=loginout">注销</a></li>
    </ul>
</div>
        <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <ul class="layui-nav layui-nav-tree" lay-filter="test">
            <li class="layui-nav-item layui-nav-itemed">
                <a class="javascript:;" href="javascript:;">后台菜单<span class="layui-nav-more"></span></a>
                <dl class="layui-nav-child">
                    <dd id="shouye">
                        <a href="/liuyan.php?c=index">首页</a>
                    </dd>
                    <dd id="xinan">
                        <a href="/liuyan.php?c=index&a=xinan">西南</a>
                    </dd>
                    <dd id="guizhou">
                        <a href="/liuyan.php?c=index&a=guizhou">贵州</a>
                    </dd>
                    <dd id="taiyuan">
                        <a href="/liuyan.php?c=index&a=taiyuan">太原</a>
                    </dd>
                </dl>
            </li>
        </ul>
    </div>
</div>
<script>
function t_nav() {
    var paths = document.URL;
    if (paths.indexOf("xinan") > 0) {
        $("#xinan").addClass("layui-this");
    } else if (paths.indexOf("guizhou") > 0) {
        $("#guizhou").addClass("layui-this");
    } else if (paths.indexOf("taiyuan") > 0) {
        $("#taiyuan").addClass("layui-this");
    } else {
        $("#shouye").addClass("layui-this");
    }
}
 t_nav();
</script>
        <div class="layui-body">
            <!-- 内容主体区域 -->
            <div style="padding: 15px;">
                <table id="demo" class="layui-table" lay-filter="demo"></table>
                <script type="text/html" id="barDemo">
                    <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="del">删除</a>
                </script>
            </div>
        </div>
    </div>
    <script>
    layui.use('table', function() {
        var table = layui.table;
        table.render({
            elem: '#demo',
            url: '/liuyan.php?c=liuyan&a=getliuyan',
            page:true,limit:15,
            cols: [
                [
                    { field: 'hospital', title: '医院', width: 60 },
                    { field: 'bs', title: '标识', event: 'detail', width: 60, templet: '#bsTpl' },
                    { field: 'name', title: '姓名', event: 'detail', width: 80 },
                    { field: 'age', title: '年龄', event: 'detail', width: 80 },
                    { field: 'sex', title: '性别', event: 'detail', width: 80, templet: '#sexTpl' },
                    { field: 'tel', title: '电话', width: 120 },
                    { field: 'height',title:'身高', event: 'detail', width: 60 },
                    { field: 'city',title:'ip', event: 'detail', width: 140, templet: '#ipTpl' },
                    { field: 'zzms', title:'描述',event: 'detail', width: 80 },
                    { field: 'tjtime',title:'提交时间', event: 'detail', width: 160 },
                    { field: 'suburl', title:'提交地址',width: 220, templet: '#subTpl' },
                    { field: 'time', title:'预约时间',event: 'detail', width: 120, templet: '#timeTpl' },
                    { field: 'zt', title:'状态',width: 80, event: 'setzt', templet: '#ztTpl' },
                    { fixed: 'right',title:'操作', width: 80, align: 'center', toolbar: '#barDemo' }
                ]
            ]
        });
    });
    </script>
    <script type="text/html" id="sexTpl">
        {{# if(d.sex === '女'){ }}
        <span style="color: #F581B1;">{{ d.sex }}</span> {{# } else { }} {{ d.sex }} {{# } }}
    </script>
    <script type="text/html" id="timeTpl">
        {{# if(d.time === '0000-00-00 00:00:00'){ }}
        <span style="color: #F581B1;">无</span> {{# } else { }} {{ d.time }} {{# } }}
    </script>
    <script type="text/html" id="bsTpl">
        {{# if(d.bs === '1'){ }}
        <span>竞价</span> {{# } else if(d.bs === '2'){ }}
        <span style="color:red;">微·自媒体</span>{{# } else { }}<span style="color:red;">外围</span> {{# } }}
    </script>
    <script type="text/html" id="subTpl">
        {{# if(d.title === '未知'){ }}
        <a href="http://{{ d.suburl }}" target="_blank">{{ d.suburl }}</a>{{# } else if(d.title === ''){ }}
        <a href="http://{{ d.suburl }}" target="_blank">{{ d.suburl }}</a> {{# } else { }}
        <a href="http://{{ d.suburl }}" target="_blank" title="{{ d.title }}">{{ d.title }}</a> {{# } }}
    </script>
    <script type="text/html" id="hospitalTpl">
        {{# if(d.hospital === '1'){ }}
        <span>西南</span>{{# } else if(d.hospital === '2'){ }}
        <span>贵州</span> {{# } else if(d.hospital === '3'){ }}
        <span>太原</span> {{# } else { }}
        <span style="color:red;">其他</span> {{# } }}
    </script>
    <script type="text/html" id="ztTpl">
        {{# if(d.zt === '0'){ }}
        <a id="shenhe_{{ d.id }}" class="zt_{{ d.zt }}">未沟通</a> {{# } else { }} <a class="zt_{{ d.zt }}" id="shenhe_{{ d.id }}">已沟通</a> {{# } }}
    </script>
    <script src='/Public/js/liuyan.js'></script>
</body>

</html>