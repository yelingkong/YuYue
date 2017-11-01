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
                    <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><dd id="taiyuan">
                            <a href="/liuyan.php?c=index&a=liuyan&hospital=<?php echo ($k); ?>"><?php echo ($vo["hname"]); ?></a>
                        </dd><?php endforeach; endif; else: echo "" ;endif; ?>
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
                <div id="chart" style="width: 100%; height: 500px;"></div>
            </div>
        </div>
    </div>
    <script src="/Public/layui/layui.js"></script>
    <script>
    $(document).ready(function() {

        var chart = document.getElementById('chart');

        var chartData = echarts.init(chart);



        chartData.setOption({

            title: {

                text: '近30天留言状况'

            },

            tooltip: {

                trigger: 'axis'

            },

            legend: {

                data: ['西南', '贵州', '太原']

            },

            grid: {

                left: '3%',

                right: '4%',

                bottom: '3%',

                containLabel: true

            },

            toolbox: {

                feature: {

                    saveAsImage: {}

                }

            },

            xAxis: {

                type: 'category',

                boundaryGap: false,

                data: []

            },

            yAxis: {

                type: 'value'

            },

            series: [{

                    name: '西南',

                    type: 'line',

                    stack: '总量',

                    data: []

                },

                {

                    name: '贵州',

                    type: 'line',

                    stack: '总量',

                    data: []

                }, {

                    name: '太原',

                    type: 'line',

                    stack: '总量',

                    data: []

                }

            ]

        });



        $.get('/liuyan.php?c=liuyan&a=lately').done(function(data) {



            console.dir(data);

            // 填入数据

            chartData.setOption({

                xAxis: {

                    data: data.times

                },

                series: [{

                        name: '西南',

                        type: 'line',

                        stack: '总量',

                        data: data.count_xinan

                    },

                    {

                        name: '贵州',

                        type: 'line',

                        stack: '总量',

                        data: data.count_guizhou

                    }, {

                        name: '太原',

                        type: 'line',

                        stack: '总量',

                        data: data.count_taiyuan

                    }

                ]

            });



        });



        function eConsole(param) {

            console.dir(param);

        }



        chartData.on("click", eConsole);

    });
    </script>
</body>

</html>