<?php
if (isset($_POST['submit2'])){
	$date1=$_POST['date1'];
	$date2=$_POST['date2'];
	$result=mysql_query("SELECT * FROM account WHERE date BETWEEN '$date1' AND '$date2';");
}else{
	$result=mysql_query("SELECT * FROM account");
}

echo <<<EOT
	<div id="accountList">
	<table>	
	<tr>
		<th>����</th><th>��</th><th>��</th><th>���</th><th>��ע</th>
	</tr>
EOT;

while($row=mysql_fetch_array($result,MYSQL_NUM)){
	echo "<tr>";
	for ($i=1;$i<=5;$i++) echo "<td>".$row[$i]."</td>";
	echo "</tr>";
}

echo <<<EOT
	</table>
	</div>
EOT;
?>