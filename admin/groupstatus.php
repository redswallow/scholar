<div id="groupstatus">
    <table id="smartable" class="tablesorter" border="0" cellpadding="0" cellspacing="1">
        <thead>
            <tr>
                <th>GroupID</th><th>Bookmark</th><th>Search</th><th>Watch</th><th>admin</th>
            </tr>
		</thead>
		<tbody>
			<?php
				$result=mysql_query("SELECT * FROM usergroup");
				while($row=mysql_fetch_array($result,MYSQL_NUM)){
					$id=$row[0];$bookmark=$row[1];$search=$row[2];$watch=$row[3];$ad=$row[4];
					echo "<tr>";
					for($i=0;$i<5;$i++){
						echo "<td>";
						if ($i>0)
							if ($row[$i]==1) echo "<font color='green'>True</font>";
							else echo "<font color='red'>False</font>";
						else echo $row[$i];
						echo "</td>";
					}
					echo "</tr>";
				}
			?>
		</tbody>
	</table>
</div>