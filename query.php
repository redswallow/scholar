<?php
if (isset($_POST['submit1']) && $_POST['num']!=0){
	$result=mysql_query("SELECT amount FROM account ORDER BY id DESC limit 0,1");
	$num_rows=mysql_num_rows($result);
	if ($num_rows=0){
		$oldAmount=0;
	}else{
		$row=mysql_fetch_array($result);
		$oldAmount=$row['amount'];
	}
	
	$date=date("Y-m-d");
	$in=0.00;$out=0.00;
	if ($_POST['savingType']=='in'){
		$in=$_POST['num'];
		$amount=$oldAmount+$in;
	}else{
		$out=$_POST['num'];
		$amount=$oldAmount-$out;
	}
	$content=$_POST['content'];

	$query="INSERT INTO account (date,drawIn,drawOut,amount,content) VALUES ('$date','$in','$out','$amount','$content');";
	$result=@mysql_query($query);
}

if (isset($_POST['submit3'])){
	$result=mysql_query("SELECT * FROM account ORDER BY id DESC limit 0,1");
	$row=mysql_fetch_array($result);
	mysql_query("DELETE FROM account WHERE id='".$row['id']."'");
	mysql_query("ALTER TABLE account AUTO_INCREMENT=".$row['id']);
}

echo <<<EOT
	<div id="accountAdd">
	<form action="index.php" method="POST">
		��<input type="text" name="num" />
		<select name="savingType">
			<option value="in" selected="selected">��</option>
			<option value="out">��</option>
		</select>
		��ע��<input type="text" name="content" />
		<input type="submit" name="submit1" value="�ύ"/> <input type="reset" value="����" />
	</form>
	</div>
	<div id="accountSearch">
	<form action="index.php" method="POST">
		�� <input type="text" name="date1" id="date1" /> <img onclick="WdatePicker({el:'date1'})" src="img/datePicker.gif" width="16" height="22" align="absmiddle">
		&nbsp�� <input type="text" name="date2" id="date2" /> <img onclick="WdatePicker({el:'date2'})" src="img/datePicker.gif" width="16" height="22" align="absmiddle">
		&nbsp<input type="submit" name="submit2" value="�ύ"/> <input type="submit" name="refresh" value="����" />
	</form>
	</div>
	<div id="accountDelete">
	<form action="index.php" method="POST">
		<input type="submit" name="submit3" value="ɾ�������" />
	</form>
	</div>
EOT;
?>