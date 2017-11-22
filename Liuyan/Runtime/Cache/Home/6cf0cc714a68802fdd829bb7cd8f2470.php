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
    <script src="/Public/layui/layui.all.js"></script>
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
                    <a class="layui-btn layui-btn-danger layui-btn-sm" data-tips="删除留言" lay-event="del">删除</a>
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
    layui.use(['table', 'form'], function() {
        var table = layui.table,
            form = layui.form;
        table.render({
            elem: '#demo',
            url: '/liuyan.php?c=liuyan&a=getliuyan&hospital=' + hospital,
            page: true,
            limit: 15,
            cols: [
                [
                    { field: 'short_title', title: '医院', width: 60, },
                    { field: 'bs', title: '标识', event: 'detail', width: 60, templet: '#bsTpl' },
                    { field: 'name', title: '姓名', width: 80 },
                    { field: 'age', title: '年龄', event: 'detail', width: 80 },
                    { field: 'sex', title: '性别', event: 'detail', width: 80, templet: '#sexTpl' },
                    { field: 'tel', title: '电话', width: 120 },
                    { field: 'city', title: 'ip', event: 'detail', width: 140, templet: '#ipTpl' },
                    { field: 'zzms', title: '描述', event: 'detail', width: 80 },
                    { field: 'suburl', title: '提交地址', width: 220, templet: '#subTpl' },
                    { field: 'height', title: '身高', event: 'detail', width: 60 },
                    { field: 'tjtime', title: '提交时间', event: 'detail', width: 160, templet: '#datasTpl' },
                    { field: 'time', title: '预约时间', event: 'detail', width: 120, templet: '#timeTpl' },
                    { field: 'zt', title: '是否沟通', width: 100, templet: '#switchTpl', },
                    { fixed: 'right', title: '操作', width: 90, align: 'center', toolbar: '#barDemo' }
                ]
            ]
        });
        //状态修改
        form.on('switch(ckzt)', function(obj) {
            var msg = obj.elem.checked ? "1" : "0";
            datas = {};
            datas['id'] = this.value,
                datas['zt'] = msg,
                $.ajax({
                    url: "/liuyan.php?c=liuyan&a=setzt",
                    data: datas,
                    type: 'post',
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 0) {
                            layer.msg(data.message, { icon: 2, time: 1000 });
                        } else if (data.status == 1) {
                            layer.msg(data.message, { icon: 1, time: 1000 });
                        } else {
                            layer.msg("数据错误", { icon: 2, time: 1000 });
                        }
                    },
                    error: function(data) {
                        layer.alert("网络错误", { icon: 2, title: "系统提示", time: 1000 });
                        $(check.elem).prop("checked", !check.elem.checked);
                        table.render("checkbox");
                    }
                });
        });
    });
    layui.use(['table', 'layer'], function() {
        var table = layui.table;
        var layer = layui.layer;
        table.on('tool(demo)', function(obj) {
            var data = obj.data;
            if (obj.event === 'detail') {
                layer.open({
                    type: 1,
                    area: ['800px', '500px'],
                    title: '详细信息',
                    shade: 0.6,
                    shadeClose: true,
                    maxmin: true,
                    anim: 1,
                    content: '<div class="tanchuang">' +
                        '<p><b>id：</b>' + data.id + '</p>' +
                        '<p><b>医院：</b>' + data.hname + '</p>' +
                        '<p><b>电话：</b><span style="color:red;">' + data.tel + '</span></p>' +
                        '<p><b>提交地址：</b><a href="http://' + data.suburl + '" target="_blank">' + data.title + '</a></p>' +
                        '<p><b>ip地址：</b>' + data.ip + '&nbsp&nbsp&nbsp<b>ip归属地：</b>' + data.city + '</p>' +
                        '<p><b>提交时间：</b>' + data.tjtime + '</p>' +
                        '<p><b>预约时间：</b>' + data.time + '</p>' +
                        '<p><b>症状描述：</b>' + data.zzms + '</p>' +
                        '</div>',
                });

            } else if (obj.event === 'del') {
                layer.confirm('确定要删除该条留言吗？', { icon: 3, title: '提示' }, function(index) {
                    datas = {};
                    datas['id'] = data.id,
                        datas['zt'] = -1,
                        url = '/liuyan.php?c=liuyan&a=setzt',
                        $.post(url, datas, function(result) {
                            if (result.status == 1) {
                                layer.msg(result.message, { icon: 1, time: 1000 });
                            }
                            if (result.status == 0) {
                                layer.msg(result.message, { icon: 0, time: 1000 });
                            }
                        }, "json");
                    obj.del();
                });
            }
        });
    });
    function timeagos(times) {
        var util = layui.util;
        return util.timeAgo(times);
    }
    </script>
    <script type="text/html" id="datasTpl">
        {{# var times=d.tjtime; return timeagos(times); }}
    </script>
    <script type="text/html" id="switchTpl">
        <input type="checkbox" value="{{d.id}}" data-id="{{d.id}}" lay-skin="switch" lay-text="是|否" lay-filter="ckzt" {{ d.zt==1 ? 'checked' : '' }}>
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
    <script type="text/html" id="ztTpl">
        <a id="shenhe_{{ d.zt }}" class="zt_{{ d.zt }}">{{ d.zt_name }}</a>
    </script>
</body>

</html>