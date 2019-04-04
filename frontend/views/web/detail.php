<div class="main">
    <div id="primary" class="primary">
        <div class="article">
            <header>
                <h1><?=$info['title']?></h1>
                <p class="info">
                    <span>分类：
                        <?php foreach ($info['subjectList'] as $k=>$v):?>
                            <?php if($k == end(array_keys($info['subjectList']))):?>
                                <a href="http://www.dowebok.com/code" rel="category tag"><?= $v['name']?></a>
                            <?php else:?>
                                <a href="http://www.dowebok.com/code" rel="category tag"><?= $v['name']?></a>,
                            <?php endif;?>
                        <?php endforeach;?>
                      </span>
                    <span>日期：<time datetime="<?=$info['registerDate']?>" pubdate><?=$info['registerDate']?></time></span>
                    <span>点击(<?=$info['analysisBrowseNum']?>)</span>
                    <span>下载(<?=$info['analysisDownloadNum']?>)</span>
                    <span>点赞(<?=$info['analysisLikeNum']?>)</span>
                    <span>收藏(<?=$info['analysisCollectionNum']?>)</span>
                    <span>评论(<span><?=$info['analysisCommentNum']?></span>)</span>
                </p>
            </header>
            <p><img style="max-width: 100%" src="<?=Yii::$app->params['domain']['pic'].$info['coverUrl']?>" alt="<?=$info['title']?>" /></p>
            <p class="vad"><a class="view" href="<?=Yii::$app->params['domain']['demo'].$info['previewUrl']?>" target="_blank" rel="noopener noreferrer">演 示</a> <a class="down" href="<?=Yii::$app->params['domain']['resource'].$info['soureUrl']?>" target="_blank" rel="noopener noreferrer">下 载</a></p>

            <h2>简介</h2>
            <p><?= $info['describe'];?></p>
            <h2>浏览器兼容</h2>
            <table class="browsers">
                <thead>
                <tr>
                    <th><img src="/img/ie.png" alt="IE" /></th>
                    <th><img src="/img/edge.png" alt="Edge" /></th>
                    <th><img src="/img/chrome.png" alt="Chrome" /></th>
                    <th><img src="/img/firefox.png" alt="Firefox" /></th>
                    <th><img src="/img/opera.png" alt="Opera" /></th>
                    <th><img src="/img/safari.png" alt="Safari" /></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>IE7+</td>
                    <td>Edge</td>
                    <td>Chrome</td>
                    <td>Firefox</td>
                    <td>Opera</td>
                    <td>Safari</td>
                </tr>
                </tbody>
            </table>
            <h2>使用方法</h2>
           <p>
               <?= $info['manual']?>
           </p>
        </div>

        <section class="xg">
            <h2 class="tt1"><span>相关文章</span></h2>
            <ul class="list2">
                <?php foreach ($recommond as $v):?>
                <li>
                    <a href="<?=\yii\helpers\Url::to(['web/'.$v['id']])?>" title="<?= $v['title']?>"><img src="<?=    Yii::$app->params['domain']['pic'].$v['coverUrl']?>" alt="<?= $v['title']?>"></a>
                    <h4><a href="<?=\yii\helpers\Url::to(['web/'.$v['id']])?>" title="<?= $v['title']?>"><?= $v['title']?></a></h4>
                </li>
                <?php endforeach;?>
            </ul>
        </section>


    </div>

    <div class="secondary">
        <aside>
            <h3><span>热门文章</span></h3>
            <ul class="list3">
                <li><a href="http://www.dowebok.com/77.html" title="jQuery全屏滚动插件fullPage.js"><img src="picture/77s.png" alt="jQuery全屏滚动插件fullPage.js"></a><a href="http://www.dowebok.com/77.html">jQuery全屏滚动插件fullPage.js</a></li>
                <li><a href="http://www.dowebok.com/143.html" title="全屏/整屏滚动组件fullPage"><img src="picture/143s.png" alt="全屏/整屏滚动组件fullPage"></a><a href="http://www.dowebok.com/143.html">全屏/整屏滚动组件fullPage</a></li>
                <li><a href="http://www.dowebok.com/131.html" title="WOW.js &#8211; 让页面滚动更有趣"><img src="picture/131s.png" alt="WOW.js &#8211; 让页面滚动更有趣"></a><a href="http://www.dowebok.com/131.html">WOW.js &#8211; 让页面滚动更有趣</a></li>
                <li><a href="http://www.dowebok.com/97.html" title="fullPage.js制作网易邮箱6.0介绍页面"><img src="picture/97s.jpg" alt="fullPage.js制作网易邮箱6.0介绍页面"></a><a href="http://www.dowebok.com/97.html">fullPage.js制作网易邮箱6.0介绍页面</a></li>
                <li><a href="http://www.dowebok.com/98.html" title="animate.css &#8211; 齐全的CSS3动画库"><img src="picture/98.png" alt="animate.css &#8211; 齐全的CSS3动画库"></a><a href="http://www.dowebok.com/98.html">animate.css &#8211; 齐全的CSS3动画库</a></li>
            </ul>
        </aside>

        <aside>
            <h3><span>随机推荐</span></h3>
            <ul class="list3">
                <li>
                    <a href="http://www.dowebok.com/251.html" title="母亲节可爱心形背景矢量素材(EPS/AI)"><img src="picture/251s.png" alt="母亲节可爱心形背景矢量素材(EPS/AI)"></a>
                    <a href="http://www.dowebok.com/251.html">母亲节可爱心形背景矢量素材(EPS/AI)</a>
                </li>
                <li>
                    <a href="http://www.dowebok.com/613.html" title="太空飞船设计404错误页面(EPS/AI)"><img src="picture/613s.png" alt="太空飞船设计404错误页面(EPS/AI)"></a>
                    <a href="http://www.dowebok.com/613.html">太空飞船设计404错误页面(EPS/AI)</a>
                </li>
                <li>
                    <a href="http://www.dowebok.com/2000.html" title="万圣节元素矢量素材(PNG)"><img src="picture/2000s.jpg" alt="万圣节元素矢量素材(PNG)"></a>
                    <a href="http://www.dowebok.com/2000.html">万圣节元素矢量素材(PNG)</a>
                </li>
                <li>
                    <a href="http://www.dowebok.com/1117.html" title="旅游元素逼真地图矢量素材(EPS/AI/PNG)"><img src="picture/1117s.png" alt="旅游元素逼真地图矢量素材(EPS/AI/PNG)"></a>
                    <a href="http://www.dowebok.com/1117.html">旅游元素逼真地图矢量素材(EPS/AI/PNG)</a>
                </li>
                <li>
                    <a href="http://www.dowebok.com/1491.html" title="多彩灯笼中秋节背景矢量素材(AI/SVG)"><img src="picture/1491s.jpg" alt="多彩灯笼中秋节背景矢量素材(AI/SVG)"></a>
                    <a href="http://www.dowebok.com/1491.html">多彩灯笼中秋节背景矢量素材(AI/SVG)</a>
                </li>

            </ul>
        </aside>

        <aside class="ad300x250">
            <!-- <script>
            var cpro_id = "u2131715";
            </script>
            <script src="js/c.js"></script> -->


            <script type="text/javascript">
                var cpro_id = "u3178191";
            </script>
            <script src="js/c.js"></script>
        </aside>
    </div>
</div>
