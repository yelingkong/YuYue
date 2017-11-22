layui.use('table', function() {
    var table = layui.table;
    
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

        } else if (obj.event === 'setzt') {
            
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
});