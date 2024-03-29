<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>jQuery Pagination</title>
<link rel="stylesheet" href="lib/pagination.css" />
<style type="text/css">
body{font-size:84%; color:#333333; line-height:1.4;}
a{color:#34538b;}
#Searchresult{width:300px; height:100px; padding:20px; background:#f0f3f9;}
</style>
<script type="text/javascript" src="../jquery.js"></script>
<script type="text/javascript" src="../jquery.pagination.js"></script>
<link rel="stylesheet" type="text/css" href="./pagination.css" />
<script type="text/javascript">
$(function(){
	//此demo通过Ajax加载分页元素
	var initPagination = function() {
		var num_entries = $("#hiddenresult div.result").length;
		// 创建分页
		$("#Pagination").pagination(num_entries, {
			num_edge_entries: 1, //边缘页数
			num_display_entries: 4, //主体页数
			callback: pageselectCallback,
			items_per_page: 1, //每页显示1项
			prev_text: "prev",
			next_text: "next"
		});
	 };
	 
	function pageselectCallback(page_index, jq){
		var new_content = $("#hiddenresult div.result:eq("+page_index+")").clone();
		$("#Searchresult").empty().append(new_content); //装载对应分页的内容
		return false;
	}
	//ajax加载
	$("#hiddenresult").load("load.html", null, initPagination);
});
</script>
</head>

<body>
<h1>jQuery Pagination</h1>
<div id="Pagination" class="pagination"><!-- 这里显示分页 --></div>
<div id="Searchresult">sub</div>
<div id="hiddenresult" style="display:none;">
	<!-- 列表元素 -->
</div>
</body>
</html>
