<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login - YA Reads</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">
<!-- begin wrapper -->
<div id="login-header"><!-- begin header -->
  <h2>Login</h2>
</div><!-- end header -->
<div id="login"> <!-- begin content -->

<form action="verify.php" method="POST">
<table class="center">
<tr>
<th>Email</th>
<td class="noborder"><input type="text" name="reviewer_email" /></td>
</tr>

<tr>
<th>Password</th>
<td class="noborder"><input type="password" name="reviewer_pwd" /></td>
</tr>

<tr>
<td colspan="2" align="center">
<input type="submit" name="submit" value="Submit" />
</td>
</tr>
</table>
</form>

</div> <!-- end content -->
</div> <!-- end wrapper -->
</body>
</html>