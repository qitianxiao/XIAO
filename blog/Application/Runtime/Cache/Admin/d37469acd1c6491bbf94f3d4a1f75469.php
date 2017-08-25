<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		
		<meta charset="utf-8">
		<title>分类修改</title>
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
				<legend>分类修改</legend>
			</fieldset>


			<form class="layui-form" action="<?php echo U('Category/update');?>" method="post">
				<div class="layui-form-item">
					<label class="layui-form-label">分类名称</label>
					<div class="layui-input-block">
						<input type="text" name="category_name" value="<?php echo ($data['category_name']); ?>" lay-verify="title" autocomplete="off" placeholder="请输入分类" class="layui-input">
					</div>
				</div>

				<div class="layui-form-item">
					<div class="layui-input-block">
					    <input type="hidden" name="id" value="<?php echo ($data['category_id']); ?>">
						<button class="layui-btn" lay-submit="">立即修改</button>
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