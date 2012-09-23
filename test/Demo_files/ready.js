jQuery(document).ready(function(){ 
    //jQuery(".tablesorter").tablesorter(); 
    var t = jQuery('#tablesorter-demo');
    jQuery.uiTableEdit( t , 
        {
            editDone : function(val,orig_text,ev, el){
                //console.log(val);
                //console.log(orig_text);
                //console.log(jQuery(el).parent().find(".key").text());
                var thead = jQuery("thead>tr>",t);
                //console.log(thead);
                var row = jQuery(el).parent().children();
                var data = [];
                
                
             
                //console.log(row);
                
                row.each(
                    function(nr){
                        var key = thead.eq(nr).text().replace(" ","_");
                        data.push(key + "=" + escape(jQuery(this).text()));         
                    }
                );
                //console.log(data);
                jQuery.ajax({
                        type: "POST",
                        url: "./include/server.php",
                        data: data.join("&"),
                        success: function(msg){
                            console.log(msg);
                        }
                });
            
            }
        }
    ); // returns t

}); 