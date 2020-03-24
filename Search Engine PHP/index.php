<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">

<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<title>Project</title>

	<link rel="stylesheet" href="./css/default.css" type="text/css">
	
	<script type="text/javascript" src="./scripts/jquery.js"></script>
	<script type="text/javascript">
	
	
	
	
		$(document).ready(function(){
		
					    		
	    		
	    	$('#container').html("<div style='font-size:50px; text-align:center;'><br><br><br><img title='preloader' src='images/preloader.gif'><div>");
  		 	  	 				
		$.ajax({
    	    type: "GET",
			url: "api/search.api.php?query="+document.getElementsByName("query")[0].value,
			dataType: "xml",
			success: function(xml) {
			$('#container').html("");
			
			var n = 0;
			var redirect= "flase";
			

			$(xml).find('specialResult').each(function(){
										var title = $(this).find('title').text();
										var url = $(this).find('url').text();
										var urlID = $(this).find('url').attr('id');
										var domainID = $(this).find('url').attr('domain');
										var cat = $(this).find('category').text();


										
										
										output  ="<div class='specialResult-div'><div class='specialResult'> <a href='./open.page.php?urlID="+urlID+"&&redirect=true&&domainID="+domainID+"'>"+title+"</a><div class='link'>"+url+"</div><div class='category'>"+cat+"</div><div class='report' onclick=\"location. href='./unlike.php?cat="+cat+"&&domainID="+domainID+"'\">report</div></div></div>"
										

										$('#container').append(output);
										n++;
										redirect = "true";	
								});
								
								
			cat = $(xml).find('specialResults').attr("caterogy");			
			
			
								$(xml).find('result').each(function(){
										var title = $(this).find('title').text();
										var url = $(this).find('url').text();
										var urlID = $(this).find('url').attr('id');
										var domainID = $(this).find('url').attr('domain');

										
										var weight =  $(this).find('weight').attr('value');
										var PageRank =  $(this).find('weight').attr('PageRank');
										var hits =  $(this).find('weight').attr('hits');

										
										
										output  ="<div class='result-div'><div class='result'> <a href='./open.page.php?urlID="+urlID+"&&domainID="+domainID+"&&redirect="+redirect+"&&cat="+cat+"'>"+title+"</a><div class='link'>"+url+"</div><div class='weight'>[Weight: "+weight+"] [Hits: "+hits+"]  [Page rank: "+PageRank+"]</div></div></div>"
										

										$('#container').append(output);
										n++;	
								});
								
				if(!n && document.getElementsByName("query")[0].value!="") $('#container').append("<div style='font-size:50px; text-align:center;'> <br><br><br>No results<div>");
								
								 
				}
			});  		 	
	    		
	    	
	    	$('#suggestions').html('<img title="preloader" src="images/preloader.gif">');		
				$.get("classes/suggestions.php", { query: document.getElementsByName("query")[0].value },
  	 				function(data){
  		 	   				$('#suggestions').html(data);   		
  		 	});
  		 	
  		 	
  		 	    
		});
	</script>
	
</head>

<body>
	<div id="header">
		
		<span id="title" onclick="location. href='./'">Search</span>
		
		<form method="get">
			<table><tr>
						<td><input id="input" type="text" value="<?php if(isset($_GET['query'])) echo $_GET['query']; ?>" name="query"></td>
						<td><input class="submit" value="Search" type="submit"></td>
					</tr>
			</table> 
		</form>
		
		<div id="menu">
			<table><tr>
					<td onclick="location. href='./crawler.php'">Crawler</td>
					<td onclick="location. href='./indexer.php'">Indexer</td>
					<td onclick="location. href='./classes/proxy.php'">Proxy</td>
					<td onclick="location. href='./data/domains.xml'">List of sites</td>
				</tr>
			</table>
		</div>
	</div>
	
	
	

		<div id='suggestions'></div>	
		
		

	
		
	<div id="container">
	
	
	</div>


	<div id='footer'>
		<div id='copyright'>Final Year Project 2012 &nbsp;</div>
	</div>
</body>
</html>