<?php defined('IN_NIUXAMS') or exit('Access Denied.');?>
<div id="Coverlayer">
<div class="ui-widget-overlay"></div>
<div class="ui-widget-shadow ui-corner-all" style="position:absolute;width:302px;height:42px;left:37%;top:40%;"></div>
<div class="progressbar ui-widget ui-widget-content ui-corner-all" style="position:absolute;width:300px;height:40px;left:37%;top:40%;">
<p style="position:absolute;left:20%;top:8px;font-weight:bold;text-shadow:1px 1px 0 #fff;font-size:1.2em;">玩命干活中，请稍后......</p>
</div>
</div>
<div id="copyright" class="ui-widget-content ui-corner-all">
<p>Powered by <strong><a href="http://www.niuxsoft.com" target="_blank" title="牛叉广告管理优化大师(niuxams)">NiuXams</a></strong> <em>Ver <?php echo NIUXAMS_VER ?></em></p>
<p>Copyright &copy; 2013-2099 <a href="http://www.niuxsoft.com" target="_blank" title="牛叉软件，软件牛叉，祝你牛叉！">NiuXsoft.Com</a>, All Rights Reserved</p>
<p><?php 
$time_end = getmicrotime();
echo '页面执行：'.($time_end-$time_start).'秒.';
?></p>
</div>
</body>
</html>