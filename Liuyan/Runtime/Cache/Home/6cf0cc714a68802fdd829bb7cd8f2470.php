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
                    <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><dd id="hospital_<?php echo ($vo["hid"]); ?>">
                            <a href="/liuyan.php?c=index&a=liuyan&hospital=<?php echo ($vo["hid"]); ?>"><?php echo ($vo["hname"]); ?></a>
                        </dd><?php endforeach; endif; else: echo "" ;endif; ?>
                </dl>
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
                    <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="del">删除</a>
                </script>
            </div>
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
    layui.use('table', function() {
        var table = layui.table;
        table.render({
            elem: '#demo',
            url: '/liuyan.php?c=liuyan&a=getliuyan&hospital=' + hospital,
            page: true,
            limit: 15,
            cols: [
                [
                    { field: 'hospital', title: '医院', width: 60, templet: '#hospitalTpl' },
                    { field: 'bs', title: '标识', event: 'detail', width: 60, templet: '#bsTpl' },
                    { field: 'name', title: '姓名', event: 'detail', width: 80 },
                    { field: 'age', title: '年龄', event: 'detail', width: 80 },
                    { field: 'sex', title: '性别', event: 'detail', width: 80, templet: '#sexTpl' },
                    { field: 'tel', title: '电话', width: 120 },
                    { field: 'height', title: '身高', event: 'detail', width: 60 },
                    { field: 'city', title: 'ip', event: 'detail', width: 140, templet: '#ipTpl' },
                    { field: 'zzms', title: '描述', event: 'detail', width: 80 },
                    { field: 'tjtime', title: '提交时间', event: 'detail', width: 160 },
                    { field: 'suburl', title: '提交地址', width: 220, templet: '#subTpl' },
                    { field: 'time', title: '预约时间', event: 'detail', width: 120, templet: '#timeTpl' },
                    { field: 'zt', title: '状态', width: 80, event: 'setzt', templet: '#ztTpl' },
                    { fixed: 'right', title: '操作', width: 80, align: 'center', toolbar: '#barDemo' }
                ]
            ]
        });
    });
    </script>
    <script type="text/html" id="sexTpl">
        {{# if(d.sex === '1'){ }}
        <span>男</span> {{# } else if(d.sex === '0'){ }}
        <span style="color: #F581B1;">女</span>{{# } else if(d.sex === '女'){ }}
        <span style="color: #F581B1;">女</span>{{# } else { }}<span>{{ d.sex }}</span> {{# } }}
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