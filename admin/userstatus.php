<div id="userstatus">
    <table id="smartable" class="tablesorter" border="0" cellpadding="0" cellspacing="1">
        <thead>
            <tr>
                <th>ID</th><th>Password</th><th>Username</th><th>Group</th>
            </tr>
		</thead>
		<tbody>
			<?php
				$result=mysql_query("SELECT * FROM user");
				while($row=mysql_fetch_array($result,MYSQL_NUM)){
					$id=$row[0];$username=$row[1];$pw=$row[2];$group=$row[3];
					echo "<tr>";
					for($i=0;$i<4;$i++) echo "<td>".$row[$i]."</td>";
					echo "</tr>";
				}
			?>
		</tbody>
	</table>

</div>