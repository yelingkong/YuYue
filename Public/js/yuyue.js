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
 function yuyue(id, bs, hospital, names, tel) {
     var sourceurls = document.referrer;
     var weburl = window.location.href;
     var sourceurl = sourceurls.split("//")[1];
     var suburl = weburl.split("//")[1];
     var data = $("#" + id).serializeArray();
     var name_ = document.getElementById(names);
     var phone = document.getElementById(tel);

     if (name_.value.length < 2) {
         alert('请输入姓名！');
         name_.focus();
         return false;
     } else if (name_.value == "") {
         alert('请输入姓名！');
         name_.focus();
         return false;
     } else if (name_.value == "请输入名字") {
         alert('请输入姓名！');
         name_.focus();
         return false;
     } else if (phone.value.length != 8 && phone.value.length != 11 && phone.value.length != 12) {
         alert('请您输入正确的电话号码！');
         phone.focus();
         return false;
     } else {
         var str2 = getCompatibility();
         postData = {};
         $(data).each(function(i) {
             postData[this.name] = this.value;
         });
         postData["title"] = document.title;
         if (typeof(postData["title"]) == "undefined") {
             postData["title"] = "未知";
         }
         if (typeof(postData["zzms"]) == "undefined") {
             postData["zzms"] = "无";
         }
         postData["zzms"] = postData["zzms"] + "<br>其他信息：" + str2 + "<br>方便接听电话时间：<span style=\"color:red\">" + postData["hdtime"] + "</span>";
         postData["hospital"] = hospital; //医院id
         postData["bs"] = bs; //标识id
         postData["sourceurl"] = sourceurl;
         postData["suburl"] = suburl;
         url = 'http://yuyue.xnekyy.cn/message.php';
         $.post(url, postData, function(result) {
             if (result.status == 0) {
                 alert(result.message);
             }
             if (result.status == 1) {
                 alert(result.message);
             }
         }, 'JSON');

     }

 }

//留言本地存储
 $("input[name='name']").blur(function() {
     var name = $("input[name='name']").val();
     localStorage.setItem("ly_name", name);
 })
 $("input[name='tel']").blur(function() {
     var tel = $("input[name='tel']").val();
     localStorage.setItem("ly_tel", tel);
 })
 $("input[name='age']").blur(function() {
     var age = $("input[name='age']").val();
     localStorage.setItem("ly_age", age);
 })
 $("textarea[name='zzms']").blur(function() {
     var zzms = $("textarea[name='zzms']").val();
     localStorage.setItem("ly_zzms", zzms);
 })

 $(function() {
     var name = localStorage.getItem("ly_name");
     var tel = localStorage.getItem("ly_tel");
     var zzms = localStorage.getItem("ly_zzms");
     var age = localStorage.getItem("ly_age");
     $("input[name='name']").attr("value", name);
     $("input[name='tel']").attr("value", tel);
     if (zzms) {
         $("textarea[name='zzms']").text(zzms);
     }
     $("input[name='age']").attr("value", age);
 });