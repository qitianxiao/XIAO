

layui.define(['laypage', 'layer', 'form', 'pagesize'], function (exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form(),
        laypage = layui.laypage;
    var laypageId = 'pageNav';

    initilData();
    //页数据初始化
    //currentIndex：当前也下标
    //pageSize：页容量（每页显示的条数）
    function initilData(currentIndex=1, pageSize=10 ) {
        var index = layer.load(1);
        //模拟数据
        var data = new Array();

        var url = "/Admin/Category/show";

        $.get(url,{'currentIndex':currentIndex,'pageSize':pageSize},function(result){

            data = result['data'];
            pages = result['pages']
            pageSize = result['pageSize'];
        },'json');


        //模拟数据加载
        setTimeout(function () {
            layer.close(index);

            var html = '';  //由于静态页面，所以只能作字符串拼接，实际使用一般是ajax请求服务器数据
            html += '<table style="" class="layui-table" lay-even>';
            // html += '<a>添加管理员</a>';
            html += '<colgroup><col width="180"><col><col width="150"><col width="180"><col width="90"><col width="90"><col width="50"><col width="50"></colgroup>';
            html += '<thead><tr><th>分类id</th><th>分类名称</th><th colspan="2">操作</th></tr></thead>';
            html += '<tbody>';
            //遍历文章集合
            for (var i = 0; i < data.length; i++) {
                var item = data[i];
                html += "<tr>";
                html += "<td>" + item.category_id + "</td>";
                html += "<td>" + item.category_name + "</td>";

                html += '<td><form class="layui-form" action=""><div class="layui-form-item" style="margin:0;"><input type="checkbox" name="top" title="置顶" value="' + item.article_id + '" lay-filter="top" checked /></div></form></td>';
                html += '<td><form class="layui-form" action=""><div class="layui-form-item" style="margin:0;"><input type="checkbox" name="top" title="推荐" value="' + item.article_id + '" lay-filter="recommend" checked /></div></form></td>';
                html += '<td><a class="layui-btn layui-btn-small layui-btn-normal" onclick="layui.datalist.editData(\'' + item.id + '\')" href="http://www.blog.com/index.php/Admin/Category/update?id=' + item.category_id + '"><i class="layui-icon">&#xe642;</i></a></td>';
                html += '<td><a class="layui-btn layui-btn-small layui-btn-danger" onclick="layui.datalist.editData(\'' + item.id + '\')" href="http://www.blog.com/index.php/Admin/Category/delete?id=' + item.category_id + '"><i class="layui-icon">&#xe640;</i></a></td>';
                html += "</tr>";
            }
            html += '</tbody>';
            html += '</table>';
            html += '<div id="' + laypageId + '"></div>';

            $('#dataContent').html(html);

            form.render('checkbox');  //重新渲染CheckBox，编辑和添加的时候
            $('#dataConsole,#dataList').attr('style', 'display:block'); //显示FiledBox

            laypage({
                cont: laypageId,
                pages: pages,
                groups: 5,
                skip: true,
                curr: currentIndex,
                jump: function (obj, first) {
                    console.log(obj);
                    console.log(first);
                    var currentIndex = obj.curr;
                    if (!first) {
                        initilData(currentIndex, pageSize);
                    }
                }
            });
            //该模块是我定义的拓展laypage，增加设置页容量功能
            //laypageId:laypage对象的id同laypage({})里面的cont属性
            //pagesize当前页容量，用于显示当前页容量
            //callback用于设置pagesize确定按钮点击时的回掉函数，返回新的页容量
            layui.pagesize(laypageId, pageSize).callback(function (newPageSize) {
                //这里不能传当前页，因为改变页容量后，当前页很可能没有数据
                initilData(1, newPageSize);
                console.log(newPageSize);
            });
        }, 1000);
    }

    //监听置顶CheckBox
    form.on('checkbox(top)', function (data) {
        var index = layer.load(1);
        setTimeout(function () {
            layer.close(index);
            if (data.elem.checked) {
                data.elem.checked = false;
            }
            else {
                data.elem.checked = true;
            }
            layer.msg('操作失败，返回原来状态');
            form.render();  //重新渲染
        }, 300);
    });

    //监听推荐CheckBox
    form.on('checkbox(recommend)', function (data) {
        var index = layer.load(1);
        setTimeout(function () {
            layer.close(index);
            layer.msg('操作成功');
        }, 300);
    });
    //添加数据
    $('#addArticle').click(function () {
        var index = layer.load(1);
        setTimeout(function () {
            layer.close(index);
            layer.msg('打开添加窗口');
        }, 500);
    });

    //输出接口，主要是两个函数，一个删除一个编辑
    var datalist = {
        deleteData: function (id) {
            layer.confirm('确定删除？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                layer.msg('删除Id为【' + id + '】的数据');
            }, function () {

            });
        },
        editData: function (id) {
            layer.msg('编辑Id为【' + id + '】的数据');
        }
    };


    exports('cate',datalist);
});