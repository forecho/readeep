<ul>
    <li>
        <label for="token">token:</label>
        <input id="token" name="token" class="ipt" value="<?php echo $token;?>"><a target="blank" href="http://jsfiddle.net/gh/get/extjs/4.2/icattlecoder/jsfiddle/tree/master/uptoken">在线生成token</a>
    </li>
    <li>
        <label for="key">key:</label>
        <input id="key" name="key" class="ipt" value="">
    </li>
    <li>
        <label for="bucket">照片:</label>
        <input id="file" name="file" class="ipt" type="file" />
    </li>
    <li>
        <input id="btn_upload" type="button" value="提交">
    </li>
    <div id="progressbar"><div class="progress-label"></div></div>
</ul>
<div id="dialog" title="上传成功"></div>
<script >

 // *   本示例演示七牛云存储表单上传
 // *
 // *   按照以下的步骤运行示例：
 // *
 // *   1. 填写token。需要您不知道如何生成token，可以点击右侧的链接生成，然后将结果复制粘贴过来。
 // *   2. 填写key。如果您在生成token的过程中指定了key，则将其输入至此。否则留空。
 // *   3. 姓名是一个自定义的变量，如果生成token的过程中指定了returnUrl和returnBody，
 // *      并且returnBody中指定了期望返回此字段，则七牛会将其返回给returnUrl对应的业务服务器。
 // *      callbackBody亦然。
 // *   4. 选择任意一张照片，然后点击提交即可
 // *
 // *   实际开发中，您可以通过后端开发语言动态生成这个表单，将token的hidden属性设置为true并对其进行赋值。
 // *
 // *  **********************************************************************************
 // *  * 贡献代码：
 // *  * 1. git clone git@github.com:icattlecoder/jsfiddle
 // *  * 2. push代码到您的github库
 // *  * 3. 测试效果，访问 http://jsfiddle.net/gh/get/jquery/1.9.1/<Your GitHub Name>/jsfiddle/tree/master/ajaxupload
 // *  * 4. 提pr
 // *   **********************************************************************************
 
$(document).ready(function() {;
    var Qiniu_UploadUrl = "http://up.qiniu.com";
    var progressbar = $("#progressbar"),
        progressLabel = $(".progress-label");
    // progressbar.progressbar({
    //     value: false,
    //     change: function() {
    //         progressLabel.text(progressbar.progressbar("value") + "%");
    //     },
    //     complete: function() {
    //         progressLabel.text("Complete!");
    //     }
    // });
    $("#btn_upload").click(function() {
        //普通上传
        var Qiniu_upload = function(f, token, key) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', Qiniu_UploadUrl, true);
            var formData, startDate;
            formData = new FormData();
            if (key !== null && key !== undefined) formData.append('key', key);
            formData.append('token', token);
            formData.append('file', f);
            var taking;
            xhr.upload.addEventListener("progress", function(evt) {
                if (evt.lengthComputable) {
                    var nowDate = new Date().getTime();
                    taking = nowDate - startDate;
                    var x = (evt.loaded) / 1024;
                    var y = taking / 1000;
                    var uploadSpeed = (x / y);
                    var formatSpeed;
                    if (uploadSpeed > 1024) {
                        formatSpeed = (uploadSpeed / 1024).toFixed(2) + "Mb\/s";
                    } else {
                        formatSpeed = uploadSpeed.toFixed(2) + "Kb\/s";
                    }
                    var percentComplete = Math.round(evt.loaded * 100 / evt.total);
                    progressbar.progressbar("value", percentComplete);
                    // console && console.log(percentComplete, ",", formatSpeed);
                }
            }, false);

            xhr.onreadystatechange = function(response) {
                if (xhr.readyState == 4 && xhr.status == 200 && xhr.responseText != "") {
                    // var blkRet = JSON.parse(xhr.responseText);
                    // console && console.log(blkRet);
                    // $("#dialog").html(xhr.responseText).dialog();
                } else if (xhr.status != 200 && xhr.responseText) {

                }
            };
            startDate = new Date().getTime();
            // $("#progressbar").show();
            xhr.send(formData);
        };
        var token = $("#token").val();
        if ($("#file")[0].files.length > 0 && token != "") {
            Qiniu_upload($("#file")[0].files[0], token, $("#key").val());
        } else {
            console && console.log("form input error");
        }
    })
})
</script>