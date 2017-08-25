<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		
		<meta charset="utf-8">
		<title>新增标签</title>
		<base href="/Public/Admin/">
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="format-detection" content="telephone=no">


		<link rel="stylesheet" href="plugin/layui/css/layui.css" media="all" />
		<link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/font-awesome.4.6.0.css">
	</head>


	<body>
		<div style="margin: 15px;"> 
			<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
				<legend>网站设置</legend>
			</fieldset>
			<form class="layui-form" action="<?php echo U('Config/show');?>" method="post">
				<div class="layui-form-item">
					<label class="layui-form-label">网站域名</label>
					<div class="layui-input-block">
						<input type="text" name="WEB_SITE" value="<?php echo ($config['WEB_SITE']); ?>" lay-verify="title" autocomplete="off" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">网站标题</label>
					<div class="layui-input-block">
						<input type="text" name="WEB_TITLE" value="<?php echo ($config['WEB_TITLE']); ?>" lay-verify="title" autocomplete="off" class="layui-input">
					</div>
				</div>

			  <div class="layui-form-item">
			    <label class="layui-form-label">单选框</label>
			    <div class="layui-input-block">
			      <input type="radio" name="IS_OFF" value="0" title="否" <?php if($config['IS_OFF'] == 0 ): ?>checked<?php endif; ?> >
			      <input type="radio" name="IS_OFF" value="1" title="是" <?php if($config['IS_OFF'] == 1 ): ?>checked<?php endif; ?>>
			    </div>
			  </div>								
				<div class="layui-form-item">
					<label class="layui-form-label">每页显示条数</label>
					<div class="layui-input-block">
						<input type="text" name="PAGE_SIZE" value="<?php echo ($config['PAGE_SIZE']); ?>" lay-verify="title" autocomplete="off" class="layui-input">
					</div>
				</div>


				<div class="layui-form-item">
					<div class="layui-input-block">
						<button class="layui-btn" lay-submit="">立即提交</button>
						<button type="reset" class="layui-btn layui-btn-primary">重置</button>
					</div>
				</div>
			</form>
		</div>
		<script type="text/javascript" src="plugin/layui/layui.js"></script>
		<script>
			layui.use(['form', 'layedit', 'laydate'], function() {
				var form = layui.form(),
					layer = layui.layer,
					layedit = layui.layedit,
					laydate = layui.laydate;


				//创建一个编辑器
				var editIndex = layedit.build('LAY_demo_editor');

			});
		</script>
	</body>


</html>