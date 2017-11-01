layui.use('table', function() {
    var table = layui.table;
    //监听工具条
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
                    '<p><b>电话：</b><span style="color:red;">' + data.tel + '</span></p>' +
                    '<p><b>ip地址：</b>' + data.ip + data.city + '</p>' +
                    '<p><b>提交时间：</b>' + data.tjtime + '</p>' +
                    '<p><b>预约时间：</b>' + data.time + '</p>' +
                    '<p><b>症状描述：</b>' + data.zzms + '</p>' +
                    '<p><b>提交地址：</b><a href="http://' + data.suburl + '" target="_blank">' + data.suburl + '</a></p>' +
                    '</div>',
            });

        } else if (obj.event === 'setzt') {
            if (data.zt == 0) {
                data.zt = 1;
            } else {
                data.zt = 0;
            }
            datas = {};
            datas['id'] = data.id,
                datas['zt'] = data.zt,
                url = '/liuyan.php?c=liuyan&a=setzt',
                $.post(url, datas, function(result) {
                    if (result.status == 1) {
                        obj.update({
                            zt: data.zt
                        });
                        zt_Modify(data.id, data.zt);
                    }
                    if (result.status == 0) {
                        alert(result.message);
                    }
                }, "json");
        } else if (obj.event === 'del') {
            datas = {};
            datas['id'] = data.id,
                datas['zt'] = -1,
                url = '/liuyan.php?c=liuyan&a=setzt',
                $.post(url, datas, function(result) {
                    if (result.status == 1) {}
                    if (result.status == 0) {
                        alert(result.message);
                    }
                }, "json");
            obj.del();
        }
    });

    $('.demoTable .layui-btn').on('click', function() {
        var type = $(this).data('type');
        active[type] ? active[type].call(this) : '';
    });
});
//JavaScript代码区域
layui.use('element', function() {
    var element = layui.element;

});

function zt_Modify(id, zt) {
    if (zt == 0) {
        $("#shenhe_" + id).text("未沟通");
    } else {
        $("#shenhe_" + id).text("已沟通");
    }
}