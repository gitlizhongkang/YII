<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<p><B><?php echo $info['name']?></B>，您好：</p>
<p>您的简历已通过<?php echo $info['companyName']?>的筛选，很高兴通知您参加面试。</p>
<p>面试时间：<?php echo $info['interTime']?></p>
<p>面试地点：<?php echo $info['interAdd']?></p>
<p>联系人：<?php echo $info['linkMan']?></p>
<p>联系电话：<?php echo $info['linkPhone']?></p>
<p>备注：<?php echo $info['content']?></p>
</body>
</html>
