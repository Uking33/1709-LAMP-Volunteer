function addNumList(i,currentPage,psize,num,tag){
	if(currentPage==i)
		return "<span style='margin-left:5px;margin-right:5px;'><input class='btn_checked' type='button' value='"+i+"'></span>";
	else
		return "<span style='margin-left:5px;margin-right:5px;'><input type='button' value='"+i+"' onClick=\"goPageList("+(i)+","+psize+","+num+",'"+tag+"');\"></span>";
}
function goPageList(pno,psize,num,tag){
    var content = document.getElementById("content"+tag);
    var pageSize = psize;//每页显示行数
    var currentPage = pno;//当前页数
    var totalPage = 0;//总页数
    if(num/pageSize > parseInt(num/pageSize)){
    	totalPage=parseInt(num/pageSize)+1;   
    }else{
        totalPage=parseInt(num/pageSize);
    }
    var startRow = (currentPage - 1) * pageSize+1;//开始显示的行
    var endRow = currentPage * pageSize;//结束显示的行
    endRow = (endRow > num)? num : endRow;
    //遍历显示数据实现分页
    for(var i=1;i<=num;i++){    
    	var str = "content"+tag+i;
        var irow = document.getElementById(str);
        if(i>=startRow && i<=endRow){
            irow.style.display = "";    
        }else{
            irow.style.display = "none";
        }
    }
    var tempStr = "<span>";
    
    if(currentPage>1){
        tempStr += "<span style='margin-left:5px;margin-right:5px;'><input type='button' value='上' onClick=\"goPageList("+(currentPage-1)+","+psize+","+num+",'"+tag+"')\"></span>";
    }
    if(totalPage<=4){
	    for(var i=1;i<=totalPage;i++){
	    	tempStr += addNumList(i,currentPage,psize,num,tag);
	    }
	}
    else{
    	if(currentPage<=2){
		    for(var i=1;i<=3;i++){
		    	tempStr += addNumList(i,currentPage,psize,num,tag);
		    }
		    tempStr += "<label>...</label>";
		    tempStr += "<span style='margin-left:5px;margin-right:5px;'><input type='button' value='"+totalPage+"' onClick=\"goPageList("+(totalPage)+","+psize+","+num+",'"+tag+"')\"></span>";
	    }
    	else if(currentPage>=totalPage-1){tempStr += "<span style='margin-left:5px;margin-right:5px;'><input type='button' value='"+1+"' onClick=\"goPageList("+(1)+","+psize+","+num+",'"+tag+"')\"></span>";
		    tempStr += "<label>...</label>";
		    for(var i=totalPage-2;i<=totalPage;i++){
		    	tempStr += addNumList(i,currentPage,psize,num,tag);
		    }
		}
    	else{
    		tempStr += "<span style='margin-left:5px;margin-right:5px;'><input type='button' value='"+1+"' onClick=\"goPageList("+(1)+","+psize+","+num+",'"+tag+"')\"></span>";
    		tempStr += "<label>...</label>";
    		for(var i=currentPage-1;i<=currentPage+1;i++){
		    	tempStr += addNumList(i,currentPage,psize,num,tag);
		    }
    		tempStr += "<label>...</label>";
    		tempStr += "<span style='margin-left:5px;margin-right:5px;'><input type='button' value='"+totalPage+"' onClick=\"goPageList("+(totalPage)+","+psize+","+num+",'"+tag+"')\"></span>";
    	}
    }
    if(currentPage<totalPage){
        tempStr += "<span style='margin-left:5px;margin-right:5px;'><input type='button' value='下' onClick=\"goPageList("+(currentPage+1)+","+psize+","+num+",'"+tag+"')\"></span>";
    }
    tempStr += "</span>"
    tempStr += "<span>&nbsp;&nbsp;第"+currentPage+"页/共"+totalPage+"页</span>";
    document.getElementById("barcon"+tag).innerHTML = tempStr;
}