<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
  <base href="/Public/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" type="image/png" href="static/i/favicon.png">
    <link rel="stylesheet" href="static/css/admin.css">
    <link rel="stylesheet" href="static/layui/css/layui.css">
    <script src="static/layui/layui.js"></script>
  </head>
  <body>
    <div class="admin">
      <div class="aleft" id="left-container"></div>
      <div class="aright">

        <fieldset class="layui-elem-field layui-field-title" style="margin: 20px 30px 20px 20px;">
          <legend>管理员添加</legend>
        </fieldset>

        <form class="layui-form bform" method="post" action="<?php echo U('Admin/save');?>" enctype="multipart/form-data">

          <div class="layui-form-item">
            <label class="layui-form-label">管理员名称</label>
            <div class="layui-input-block">
              <input type="text" value="<?php echo ($data['admin_name']); ?>" name="admin_name" required lay-verify="required" autocomplete="off" class="layui-input">
            </div>
          </div>

          <div class="layui-form-item">
            <label class="layui-form-label">管理员密码</label>
            <div class="layui-input-block">
              <input type="text" name="admin_pwd" required lay-verify="url" placeholder="必填内容" autocomplete="off" class="layui-input">
            </div>
          </div>

          <!--<div class="layui-form-item">
            <label class="layui-form-label">LOGO</label>
            <div class="layui-input-block">
              <div class="file-box">
                <i class="layui-icon">&#xe61f;</i>
                <input class="file-btn" type="button" value="选择图片">
                <input class="file-txt" type="text" name="youlian.logo" id="textfield">
                <input class="file-file" type="file" name="pic" id="pic" size="28" onchange="document.getElementById('textfield').value=this.value" />
              </div>
            </div>
          </div>-->

          <div class="layui-form-item">
            <div class="layui-input-block">
            <input type="hidden" name="id" value="<?php echo ($data['admin_id']); ?>">
              <input type="submit" class="layui-btn" value="修改">
              <button class="layui-btn layui-btn-primary" onclick="history.go(-1)">返回</button>
            </div>
          </div>

        </form>
        <script>
          layui.config({
            base:'static/js/'
          }).use('youlian-add');
        </script>
      </div>
    </div>
  </body>

</html>