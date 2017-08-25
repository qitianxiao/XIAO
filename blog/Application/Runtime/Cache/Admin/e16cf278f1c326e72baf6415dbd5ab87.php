<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		
		<meta charset="utf-8">
		<title>新增博文</title>
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
				<legend>新增博文</legend>
			</fieldset>


			<form class="layui-form" action="<?php echo U('Article/insert');?>" method="post">
				<div class="layui-form-item">
					<label class="layui-form-label">博文标题</label>
					<div class="layui-input-block">
						<input type="text" name="article_title" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">作者</label>
					<div class="layui-input-block">
						<input type="text" name="article_author" lay-verify="required" placeholder="请输入作者" autocomplete="off" class="layui-input">
					</div>
				</div>
				


				<div class="layui-form-item">
					<label class="layui-form-label">分类</label>
					<div class="layui-input-block">
						<select name="category_id" lay-filter="aihao" lay-verify="category">
							<?php if(is_array($cate)): foreach($cate as $key=>$v): ?><option value="<?php echo ($v['category_id']); ?>"><?php echo ($v['category_name']); ?></option><?php endforeach; endif; ?>
						</select>
					</div>
				</div>


				
				<div class="layui-form-item">
					<label class="layui-form-label">标签</label>
					<div class="layui-input-block">
					<?php if(is_array($list)): foreach($list as $key=>$vo): ?><input type="checkbox" name="label_id[]" value="<?php echo ($vo["label_id"]); ?>" title="<?php echo ($vo["lable_name"]); ?>"><?php endforeach; endif; ?>	
					</div>
				</div>

				<div class="layui-form-item layui-form-text">
					<label class="layui-form-label">编辑器</label>
					<div class="layui-input-block">
						<textarea class="layui-textarea layui-hide" name="article_content" lay-verify="content" id="LAY_demo_editor"></textarea>
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