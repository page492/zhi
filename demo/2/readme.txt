update  2013.5.20

1������404.html prompt.html

2�������ϴ�ͷ��Ч��


update  2013.5.18

1������register-step2.html ҳ��

2���޸�recom-list li��ǩ�ĸ߶ȣ���ֹҳ�����



update  2013.5.13

1��detailҳ��
<a href="" class="item-img"><img src="materials/apps/home/feeds-2.jpg" alt="ͼƬ" /></a>
����
<div href="" class="item-img"><img src="materials/apps/home/feeds-2.jpg" alt="ͼƬ" /></div>

2������searchҳ��

3������.hd-bar����ʽ������ie

4��ȥ��.search-bd����� label ��ǩ



update  2013.4.22

1������Ĭ��ͷ��../img/avatar/

2������no-pic.png������ͼƬ����../img/

3������icoͼƬ����Ŀ¼

4������table��ʽ



update  2013.4.21

1����ҳ�޸�ͷ����ȥ��.login-bar������.hd-bar

2���޸�ihomeҳ�����û�������ѡ�С�δѡ�����
δѡ�У�
<dl>
      <dt><a target="_self" href="">���<i></i></a></dt>
</dl>
ѡ�У�
<dl class="selected">
      <dt><a target="_self" href="">�ղ�&ϲ��<i></i></a></dt>
</dl>

3����������ҳ�棨baoliao.html�����м��λ�ã�crumb �ŵ�content����

4���޸�ihome.html ihome-list.htmlҳ�沼����ʽ��
   iHome-info��iHome-left��iHome-right�޸�Ϊ��i-info��i-left��i-right
	
5��detailҳ���������ӷ�ҳ

6�����ӹ������ǡ��������ӡ���վ��ͼҳ��  about.html link.html map.html





update  2013.4.14


��ҳ�޸ģ�

1��ͷ������<div class="login-bar"><a href=>ע��</a> | <a href=>��¼</a></div>

2������js/plugins/dropdown.js

3������ť��������Ч��
  �޶���������������
  <div class="item-buy"><a href="" class="btn-buy">���ֱ�ӹ���</a></div>
  �ж���������������
  <div class="item-buy">
     <a href="javascript:void(0);" class="btn-buy">���ֱ�ӹ���</a>
     <ul>
        <li><a href="">��è DT235</a></li>
        <li><a href="">���� DT235</a></li>
     </ul>
  </div>
  js���÷�ʽ��$('#J_Feeds .item-buy').dropdown({inner: 'ul'});


4���Ҳ�Ļõ�Ƭ���ӱ��⣬��ʽ���£�
<li>
     <a href="">
         <img src="materials/apps/pic-2.jpg" alt="ͼƬ">
         <div>��ȥ���˰ɣ�Soviet Russian Civilian Gas Mask</div>
     </a>
</li>

5���������Ƽ����͡�������������־html�ṹ
<article class="feed-item sign-new��sign-hot��">
    <h3 class="item-tit">
         <i class="item-sign"></i>
         <a href="">ɹ��㳡���ߣ�һ���������ʲôֵ���򡱰�~~~</a>
    </h3>
</article>

6���Ƽ�����9�������һ������Ϊ �鿴����
<a href="">�鿴���� ...</a>

7������ͼƬ����ˮƽ��ֱ����Ч����������ʽitem-img
<a href="" class="item-img"><img src="materials/apps/home/feeds-2.jpg" alt="ͼƬ" /></a>



�����޸ģ�
1��detailҳ��ȥ�����������Ч����

2��detailҳ��ɾ��item-bar�����item-buy��

3��detailҳ�����ӹ���ť������Ч��,Ϊfeed-detail����id="J_Feeds",
   Ȼ��js����$('#J_Feeds .item-buy').dropdown({inner: 'ul'});

4��detailҳ��ı���ͼƬҲ����ˮƽ��ֱ����Ч������������ҳһ��

5��ȥ��������ҳ����������

6���޸�hold.js�е� HoldPHP.showAllFeed()����;

