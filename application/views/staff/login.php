<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('common/head');?>
    </head>
    <body>
        <?php $this->load->view('common/admin_header');?>
		<form>
			<table border="1">
				<tr>
					<td>Username:</td>
					<td><input type = "text" name = "username" /></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type = "pass" name = "password" /></td>
				</tr>
				<tr>
					<td colspan = "2">
						<input type = "submit" value = "Login"/>
					</td>
				</tr>
			</table>
		</form>
    </body>
</html>