<?php
use yii\widgets\LinkPager;
?>
    <span class="layui-breadcrumb">
  <a href="">网站模板</a>
  <a><cite>分类管理</cite></a>
</span>
<div class="row top20per">
    <button class="layui-btn layui-btn-sm">
        <i class="layui-icon">&#xe608;</i> 添加
    </button>
</div>
<table class="layui-table center-table">
    <colgroup>
        <col width="150">
        <col width="200">
        <col>
    </colgroup>
    <thead>
    <tr class="center">
        <th>ID</th>
        <th>名称</th>
        <th>排序</th>
        <th>PID</th>
        <th>父级</th>
        <th>等级</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($list as $v):?>
    <tr>
        <td><?= $v['id']?></td>
        <td><?= $v['name']?></td>
        <td><?= $v['sort']?></td>
        <td><?= $v['pid']?></td>
        <td><?= $v['pid']?></td>
        <td><?= $v['level']?></td>
        <td>
            <div class="layui-btn-group">
                <a class="layui-btn layui-btn-sm  ">添加子分类</a>
                <a class="layui-btn layui-btn-sm  layui-btn-normal">修改</a>
                <button class="layui-btn layui-btn-sm layui-btn-danger">删除</button>
            </div>
        </td>
    </tr>
    <?php endforeach;?>
    </tbody>
</table>

<?= LinkPager::widget(['pagination' => $pages]); ?>