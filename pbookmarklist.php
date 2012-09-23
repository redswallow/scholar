<?php 
	$result=mysql_query("SELECT perpage FROM user where id='$uid'");
	$row=mysql_fetch_array($result,MYSQL_NUM);
	$perpage=$row[0];
?>
<script type="text/javascript">
$(function(){
	var per_page_setting ="<?php echo $perpage?>";
	var num_entries = $("#hiddenresult div.paper").length;
	var initPagination = function() {
		$("#Pagination").pagination(num_entries, {
			num_edge_entries: 1,
			num_display_entries: 4,
			callback: pageselectCallback,
			items_per_page:per_page_setting
		});

		var items_per_page=per_page_setting;
		var page_index=0;
		var max_elem = Math.min((page_index+1) * items_per_page, num_entries);
		$("#paperlist").empty();
		var new_content='';
		for(var i=page_index*items_per_page;i<max_elem;i++){
            new_content=$("#hiddenresult div.paper:eq("+i+")").clone();
			$("#paperlist").append(new_content);
        }
	 }();
	 
	function pageselectCallback(page_index, jq){
		var items_per_page=per_page_setting;
		var max_elem = Math.min((page_index+1) * items_per_page, num_entries);
		$("#paperlist").empty();
		var new_content='';
		for(var i=page_index*items_per_page;i<max_elem;i++){
            new_content=$("#hiddenresult div.paper:eq("+i+")").clone();
			$("#paperlist").append(new_content);
        }
		return false;
	}
});
</script>
<div id="paperlist"></div>
<div id="Pagination" align="center"></div>
<div id="hiddenresult" style="display:none;">
<?php
	$uid=$_SESSION['uid'];
	$result=mysql_query("SELECT * FROM paper where id in(select paper_id from user_bookmark_paper where user_id='$uid')");
	while($row=mysql_fetch_array($result,MYSQL_NUM)){
		$paper_id=$row[0];$title=$row[1];$abstract=$row[2];$year=$row[3];$url=$row[4];$cite=$row[5];
?>
	<div class="paper" onmouseover="this.style.backgroundColor='#F7F3E8';" onmouseout="this.style.backgroundColor='#FFF';" style="background-color: rgb(255,255,255);" >
		<span class="title"><a href="<?php echo $url; ?>"><?php echo $title; ?></a></span><br />
		<span class="info">
		<?php 
			echo "Year : ",$year," By : ";
			$author_res=mysql_query("select name from author where id in(SELECT author_id FROM author_has_paper where paper_id='$paper_id')");
			if($author_row=mysql_fetch_array($author_res,MYSQL_NUM)) echo $author_row[0];
			while($author_row=mysql_fetch_array($author_res,MYSQL_NUM))
				echo ' , ',$author_row[0];
		?>
		</span><br />
		<span class="info">Cite: <?php echo $cite; ?></span>
		<span class="abstract"><b>Abstract : </b><?php echo $abstract; ?></span>
		<span class="feedback">
			<a id="bookmark_paper" href="bookmark.php?type=delinlist&paper_id=<?php echo $paper_id;?>"><font color="red">[UnBookmark]</font></a>
			<a id="google_it" href="http://scholar.google.com/scholar?hl=en&q=<?php echo $title;?>"><font color="green">[Google it]</font></a>
		</span>
	</div>
	<?php } ?>
</div>