<form method="post" action="http://up.qiniu.com" enctype="multipart/form-data">
    <ul>
        <li>
            <label for="token">token:</label>
            <input type="hidden" id="token" name="token" class="ipt" value="<?php echo $token;?>"><a target="blank" href="http://jsfiddle.net/gh/get/extjs/4.2/icattlecoder/jsfiddle/tree/master/uptoken">在线生成token</a>

        </li>
        <li>
            <label for="key">key:</label>
            <input name="key" class="ipt" value="">
        </li>
        <li>
            <label for="x:username">姓名(自定义变量):</label>
            <input name="x:username" class="ipt" value="">
        </li>
        <li>
            <label for="bucket">照片:</label>
            <input name="file" class="ipt" type="file" />
        </li>
        <li>
            <input type="submit" value="提交">
        </li>
    </ul>
</form>