<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form method="post" action="http://up-z1.qiniu.com" enctype="multipart/form-data">
    <input name="token" type="hidden" value="{{$token}}">
    <input name="file" type="file" />
    <input type="submit" value="上传"/>
</form>

</body>
</html>