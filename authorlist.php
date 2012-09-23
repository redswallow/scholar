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
	$result=mysql_query("SELECT * FROM author");
	while($row=mysql_fetch_array($result,MYSQL_NUM)){
		$author_id=$row[0];$name=$row[1];$email=$row[2];$homepage=$row[3];$school_id=$row[4];$faculty=$row[5];$title=$row[6];$paper_n=$row[7];
		$school_res=mysql_query("SELECT * FROM school where id='$school_id'");
		$school_row=mysql_fetch_array($school_res,MYSQL_NUM);
		$school_name=$school_row[1];$school_rank=$school_row[3];
?>
	<div class="paper" onmouseover="this.style.backgroundColor='#F7F3E8';" onmouseout="this.style.backgroundColor='#FFF';" style="background-color: rgb(255,255,255);" >
		<span class="title"><a href="<?php echo $homepage; ?>"><?php echo $name; ?></a></span><br />
		<span class="info">
		<?php 
			echo "Email : ".$email." School : ".$school_name."(".$school_rank.") Faculty: ".$faculty;
		?>
		</span><br />
		<span class="info">Research interests: 
		<?php 
			$author_res=mysql_query("select name from field where id in(SELECT field_id FROM author_in_field where author_id='$author_id')");
			if($author_row=mysql_fetch_array($author_res,MYSQL_NUM)) echo $author_row[0];
			while($author_row=mysql_fetch_array($author_res,MYSQL_NUM))
				echo ' , ',$author_row[0];
		?>
		</span>
		<span class="feedback">
			<?php
				$book_res=mysql_query("select count(*) from user_bookmark_author where user_id='$uid' and author_id='$author_id';");
				$book_row=mysql_fetch_array($book_res,MYSQL_NUM);
				if($book_row[0] == 1){?>
					<a id="bookmark_author" href="bookmark.php?type=del&author_id=<?php echo $author_id;?>"><font color="red">[UnBookmark]</font></a>
			<?php }else{ ?>
					<a id="bookmark_author" href="bookmark.php?type=add&author_id=<?php echo $author_id;?>"><font color="green">[Bookmark]</font></a>
			<?php } ?>
			<a id="google_it" href="http://scholar.google.com/scholar?hl=en&q=<?php echo $name;?>"><font color="green">[Google it]</font></a>
		</span>
	</div>
	<?php } ?>
</div>