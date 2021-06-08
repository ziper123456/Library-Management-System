<?php
	$title=$_GET['title'];
		$sql= "select bid,isbn,Title, AuthorName from Books,Author where Author.AuthourID=Books.AuthorID and Books.Title='".$title."';";
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$result = sqlsrv_query($conn,$sql,$params,$options);
		$row = sqlsrv_fetch_array($result);
		if($row)
		{
			$auname=$row[3];
			$title=$row[2];
			$isbn = $row[1];
			$bid = $row[0];	
		}
		$sql = "select * from BookDetail where bid='".$bid."';";
		$result =sqlsrv_query($conn,$sql);
		if($row=sqlsrv_fetch_array($result))
		{
			$link=$row[1];
            $weight=$row[2];
            $lang=$row[3];
            $publisher=$row[4];
            $pages=$row[5];
            $description=$row[6];
		}
?>