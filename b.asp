<% 
	    var arr = Request.Form("id") 
	    '......處理內容 
	    if flag = 1 then                    '判斷處理是否成功 
	        response.write arr 
	    else 
	        response.write "處理失敗!" 
	    end if 
	 
%>