<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>留言</title>
</head>
<link href="/public/css/2016.css" rel="stylesheet" type="text/css" />
<link href="/public/css/iconfont.css" rel="stylesheet" type="text/css" />
<script src="http://apps.bdimg.com/libs/jquery/1.9.0/jquery.min.js"></script>

<body>
    <form method="post" name="form1" id="gh_form" target="frameNo" class="form1" style="background: #EEEEEE">
        <div class="nrjjsb">
            <div class="titlecw">
                <span>网络联合初诊表</span>
                <samp>Associates diagnosed table</samp>
                <div class="titlecw-img1"><img src="/public/images/header_bgimg_03.jpg" alt=""></div>
                <div class="titlecw-img2"><img src="/public/images/header_bgimg_03.jpg" alt=""></div>
            </div>
            <div class="jiange"></div>
            <div class="nr_n1">
                <p>1、孩子现在主要有什么症状？</p>
                <div class="nr_n1_dx">
                    <p>
                        <label>
                            <input type="checkbox" name="zyzz" value="孩子现在主要有什么症状:多动" id="diagnose_0">
                            <a>多动 </a></label>
                        <label>
                            <input type="checkbox" name="zyzz" value="孩子现在主要有什么症状:学习困难" id="diagnose_1">
                            <a> 学习困难</a></label>
                        <label>
                            <input type="checkbox" name="zyzz" value="孩子现在主要有什么症状:注意力不集中" id="diagnose_2">
                            <a>注意力不集中</a></label>
                        <label>
                            <input type="checkbox" name="zyzz" value="孩子现在主要有什么症状:脾气暴躁" id="diagnose_2">
                            <a>脾气暴躁</a></label>
                        <label>
                            <input type="checkbox" name="zyzz" value="孩子现在主要有什么症状:不听管教" id="diagnose_2">
                            <a>不听管教</a></label>
                        <label>
                            <input type="checkbox" name="zyzz" value="孩子现在主要有什么症状:无危险意识" id="diagnose_2">
                            <a>无危险意识</a></label>
                    </p>
                </div>
            </div>
            <div style=" clear:both"></div>
            <div class="nr_n1">
                <p>2、孩子出现以上症状多久了？</p>
                <div class="nr_n1_dx">
                    <p>
                        <label>
                            <input type="radio" name="duojiu" value="孩子出现以上症状多久了：1~3个月" id="diagnose_0">
                            <a>1~3个月</a></label>
                        <label>
                            <input type="radio" name="duojiu" value="孩子出现以上症状多久了： 3~6个月" id="diagnose_1">
                            <a> 3~6个月</a></label>
                        <label>
                            <input type="radio" name="duojiu" value="孩子出现以上症状多久了：6个月~1年" id="diagnose_2">
                            <a>6个月~1年</a></label>
                        <label>
                            <input type="radio" name="duojiu" value="孩子出现以上症状多久了：1年以上" id="diagnose_3">
                            <a>1年以上</a></label>
                    </p>
                </div>
            </div>
            <div style=" clear:both"></div>
            <div class="nr_n1">
                <p>3、目前接受过哪些治疗？</p>
                <div class="nr_n1_dx">
                    <p>
                        <label>
                            <input type="checkbox" name="ks" value="目前接受过哪些治疗:西药" id="diagnose_0">
                            <a>西药</a></label>
                        <label>
                            <input type="checkbox" name="ks" value="目前接受过哪些治疗:中成药" id="diagnose_1">
                            <a>中成药</a></label>
                        <label>
                            <input type="checkbox" name="ks" value="目前接受过哪些治疗:偏方" id="diagnose_2">
                            <a>偏方</a></label>
                        <label>
                            <input type="checkbox" name="ks" value="目前接受过哪些治疗:行为训练" id="diagnose_3">
                            <a>行为训练</a></label>
                        <label>
                            <input type="checkbox" name="ks" value="目前接受过哪些治疗:未接受过治疗" id="diagnose_4">
                            <a>未接受过治疗</a></label>
                    </p>
                </div>
            </div>
            <div style=" clear:both"></div>
            <div class="nr_n1">
                <p>4、您更想了解的是？</p>
                <div class="nr_n1_dx">
                    <p>
                        <label>
                            <input type="checkbox" name="ks" value="您更想了解的是：病情咨询" id="diagnose_0">
                            <a>病情咨询</a></label>
                        <label>
                            <input type="checkbox" name="ks" value="您更想了解的是：治疗方法" id="diagnose_1">
                            <a> 治疗方法</a></label>
                        <label>
                            <input type="checkbox" name="ks" value="您更想了解的是：治疗费用" id="diagnose_2">
                            <a>治疗费用</a></label>
                        <label>
                            <input type="checkbox" name="ks" value="您更想了解的是：治疗周期" id="diagnose_3">
                            <a>治疗周期 </a></label>
                        <label>
                            <input type="checkbox" name="ks" value="您更想了解的是：其他事宜" id="diagnose_4">
                            <a>其他事宜</a></label>
                    </p>
                </div>
            </div>
            <!--多动症 注意力不集中 学习困难-->
            <div class="nr_n2">
                <div class="nr_n2_d1">
                    <label>姓名：</label>
                    <input name="name" type="text" id="name" class="name" placeholder="孩子姓名">
                    <div class="msgbox">
                        <label>年龄：</label>
                        <input name="age" type="text" id="age" class="name" placeholder="孩子年龄">
                    </div>
                </div>
                <div class="nr_n2_d3">
                    <div class="msgbox2">
                        <label>性别：</label>
                        <input type="radio" name="sex" checked="checked" value="男" id="sex_0">
                        <a>男</a>
                        <input type="radio" name="sex" value="女" id="sex_1">
                        <a>女</a>
                    </div>
                    <div class="msgbox1">
                        <label>电话：</label>
                        <input name="tel" type="text" id="tel" class="name" placeholder="家长电话">
                    </div>
                </div>
            </div>
            <!--患者信息结束-->
            <div class="nr_n2_d4">
                <p>症状描述：</p>
                <div>
                    <textarea name="zzms" id=""></textarea>
                </div>
            </div>
            <div class="anniu1">
                <input type="button" name="submit" class="act-submit" id="submit" onclick="tijiao()" value="提交问题">
                <input type="reset" class="act-submit1 act-submit2" onclick="" value="重新填写">
            </div>
            <div class="wxts">
                <p><strong>温馨提示：</strong>您所填的信息我们将及时反馈给医生进行诊断，对于您的个人信息我们承诺保密！请您放心</p>
            </div>
        </div>
        <!--  </div> -->
    </form>
    <!--联合初诊表结束-->
    <script>
    /*获取表单输入框内容*/

    function getCompatibility() {
        var compatibility = "",
            input = document.getElementsByTagName("input"),
            value;
        for (var i = 0; i < input.length; i++) {
            if (input[i].type == "checkbox") {
                if (input[i].checked) {
                    value = input[i].value;
                    compatibility += value + ",<br/>";
                }
            }

        }
        compatibility = compatibility.substring(0, compatibility.lastIndexOf(","));
        return compatibility;
    }
    /*提交表单事件*/
    function tijiao() {
        var cnmurl = document.referrer;
        var weburl = window.location.href;
        var cnmwda = cnmurl.split("//")[1];

        var weburla = weburl.split("//")[1];

        var data = $("#gh_form").serializeArray();

        var name_ = document.getElementById('name');

        var phone_ = document.getElementById('tel');

        if (name_.value.length < 2) {
            dialog.error('请输入姓名！');

            name_.focus();

            return false;

        } else if (name_.value == "") {
            dialog.error('请输入姓名！');
            name_.focus();
            return false;
        } else if (name_.value == "请输入名字") {
            dialog.error('请输入姓名！');
            name_.focus();
            return false;
        } else if (phone_.value.length != 8 && phone_.value.length != 11 && phone_.value.length != 12) {
            dialog.error('请您输入正确的电话号码！');
            phone_.focus();
            return false;
        } else {
            var str2 = getCompatibility();
            postData = {};
            $(data).each(function(i) {
                postData[this.name] = this.value;
            });
            postData["zzms"] = postData["zzms"] + "<br>其他信息：" + str2 + "<br>出现了多久:" + postData["duojiu"];
            postData["hospital"] = 1;
            postData["weburla"] = weburla;
            postData["cnmwda"] = cnmwda;
            url = '/liuyan.php/home/index/add';
            $.post(url, postData, function(result) {

                if (result.status == 0) {
                     dialog.error(result.message);
                }
                if (result.status == 1) {
                     dialog.success2(result.message);
                }

            },'JSON');

        }

    }
    </script>
    <script src="/public/js/layer/layer.js"></script>
    <script src="/public/js/dialog.js"></script>
</body>

</html>