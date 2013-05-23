update  2013.5.20

1、增加404.html prompt.html

2、增加上传头像效果


update  2013.5.18

1、增加register-step2.html 页面

2、修改recom-list li标签的高度，防止页面错乱



update  2013.5.13

1、detail页面
<a href="" class="item-img"><img src="materials/apps/home/feeds-2.jpg" alt="图片" /></a>
换成
<div href="" class="item-img"><img src="materials/apps/home/feeds-2.jpg" alt="图片" /></div>

2、增加search页面

3、调整.hd-bar的样式，兼容ie

4、去掉.search-bd里面的 label 标签



update  2013.4.22

1、增加默认头像到../img/avatar/

2、增加no-pic.png（暂无图片）到../img/

3、增加ico图片到根目录

4、增加table样式



update  2013.4.21

1、首页修改头部。去掉.login-bar，增加.hd-bar

2、修改ihome页面左侧没有子类的选中、未选中情况
未选中：
<dl>
      <dt><a target="_self" href="">打分<i></i></a></dt>
</dl>
选中：
<dl class="selected">
      <dt><a target="_self" href="">收藏&喜欢<i></i></a></dt>
</dl>

3、调整爆料页面（baoliao.html）面包屑的位置：crumb 放到content外面

4、修改ihome.html ihome-list.html页面布局样式：
   iHome-info、iHome-left、iHome-right修改为：i-info、i-left、i-right
	
5、detail页面评价增加翻页

6、增加关于我们、友情链接、网站地图页面  about.html link.html map.html





update  2013.4.14


首页修改：

1、头部增加<div class="login-bar"><a href=>注册</a> | <a href=>登录</a></div>

2、增加js/plugins/dropdown.js

3、购买按钮增加下拉效果
  无多个购买链接情况：
  <div class="item-buy"><a href="" class="btn-buy">点击直接购买</a></div>
  有多个购买链接情况：
  <div class="item-buy">
     <a href="javascript:void(0);" class="btn-buy">点击直接购买</a>
     <ul>
        <li><a href="">天猫 DT235</a></li>
        <li><a href="">京东 DT235</a></li>
     </ul>
  </div>
  js调用方式：$('#J_Feeds .item-buy').dropdown({inner: 'ul'});


4、右侧的幻灯片增加标题，格式如下：
<li>
     <a href="">
         <img src="materials/apps/pic-2.jpg" alt="图片">
         <div>出去吓人吧！Soviet Russian Civilian Gas Mask</div>
     </a>
</li>

5、调整“推荐”和“新增”宝贝标志html结构
<article class="feed-item sign-new（sign-hot）">
    <h3 class="item-tit">
         <i class="item-sign"></i>
         <a href="">晒物广场上线，一起来“秀点什么值得买”吧~~~</a>
    </h3>
</article>

6、推荐宝贝9宫格最后一个调整为 查看更多
<a href="">查看更多 ...</a>

7、宝贝图片增加水平垂直居中效果，增加样式item-img
<a href="" class="item-img"><img src="materials/apps/home/feeds-2.jpg" alt="图片" /></a>



其他修改：
1、detail页面去掉标题的链接效果；

2、detail页面删掉item-bar里面的item-buy；

3、detail页面增加购买按钮的下拉效果,为feed-detail增加id="J_Feeds",
   然后js调用$('#J_Feeds .item-buy').dropdown({inner: 'ul'});

4、detail页面的宝贝图片也增加水平垂直居中效果，方法和首页一样

5、去掉其他内页的友情链接

6、修改hold.js中的 HoldPHP.showAllFeed()方法;

