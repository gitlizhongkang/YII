<?php 
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>验证邮箱</title>
</head>
<body>
<p>您好：</p>
<p>拉勾已经收到了你的找回密码请求，请点击<a href="http://192.168.1.11/nine/YII/frontend/web/index.php?r=register/update-pwd&code=<?=$code?>">此链接重置密码。</a></p>
<p>（本链接将在1天后失效）</p>
 <p>拉勾团队 </p>
<p><?=date('Y-m-d',time())?></p>
</body>
</html>