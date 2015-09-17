<?php
	// 汎用ページャー 

	 define('SHOW_INDEX_MAX',7); //奇数を指定すること
	 define('OBJECT_NUM_PER_PAGE',10);

	 // test data array
	 $data = array();for($i=0;$i<361;$i++) {$data[$i] = $i;}

	 // page
	 $page = ( isset($_GET['p']) ) ? $_GET['p'] : 1;

	 if ( !is_numeric($page) ) header('Location:tournament/error.html');

	 function pager($limit,$page=1,$count=0) {
		  //echo $limit;echo '<br />';echo $page;echo '<br />';

		  // データが０件の場合空文字を戻す
		  if ( $count == 0 ) return '';

		  // 最終ページの算出
		  $last_page = ceil($count/OBJECT_NUM_PER_PAGE);
		  //echo '  last_page=' .$last_page. '	';

		  // 左右の最大表示インデックス数
		  $lr_index_num = (SHOW_INDEX_MAX-1) / 2;
		  //echo '  lr_index_num=' .$lr_index_num. '	';

		  // カレントページがlr_index_num以下
		  if ( $page <= $lr_index_num ) {
			   //echo 'カレントページがlr_index_num以下';

			   $start_index = 1;
			   $end_index = (SHOW_INDEX_MAX > $last_page) ? $last_page : SHOW_INDEX_MAX;

			   // ページャー作成
			   return create_pager_tag($start_index,$end_index,$page,$last_page,"test.html",$div=null);

		  } else if ( $page > ($last_page - $lr_index_num) ) {
			   // カレントページが最終ページ - lr_index_num以上
			   //echo 'カレントページが最終ページ-lr_index_num以上';

			   $start_index = $last_page - (SHOW_INDEX_MAX - 1);
			   $end_index = $last_page;

			   // ページャー作成
			   return create_pager_tag($start_index,$end_index,$page,$last_page,"test.html",$div=null);

		  } else {		  // カレントページの左右にlr_index_num分インデックスを表示
			   //echo 'カレントページの左右にlr_index_num分インデックスを表示';
			   $start_index = $page - $lr_index_num;
			   $end_index = $page + $lr_index_num;

			   // ページャー作成
			   return create_pager_tag($start_index,$end_index,$page,$last_page,"test.html",$div=null);
		  }

	 }

	 function create_pager_tag($start_index,$end_index,$page=1,$last_page,$base_url="",$div=null) {

		  if ( empty($start_index) || empty($end_index) || empty($last_page) ) return '';

		  // debug echo "start:" .$start_index. "  ";echo "end:" .$end_index. "<br />";

		  for($i=$start_index;$i<=$end_index;$i++){

			   if ( $page != $i ) {
					$tag .= '<li><a href="' .$base_url. '?p=' .$i. '">' .$i. '</a></li>';
			   } else {
					$tag .= '<li class="active">' .$i. '</li>';
			   }
		  }

		  if ( $page != 1 ) {
			   $prev = $page-1;
			   $tag = '<li><a href="' .$base_url. '?p=1">&lt;&lt;</a></li><li><a href="test.html?p=' .$prev. '">&lt;</a></li>' .$tag;
		  }

		  if ( $page != $end_index ) {
			   $next = $page+1;
			   $tag = $tag. '<li><a href="' .$base_url. '?p=' .$next. '">&gt;</a></li><li><a href="test.html?p=' .$last_page. '">&gt;&gt;</a></li>';
		  }


		  if ( isset($div) ) {
			   $tag = $div .$tag;
		  } else {
			   $tag = '<div id="pagenation"><ul>' .$tag;
		  }

		  $tag .= '</ul></div>';

		  return $tag;

	 }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript">
function Test()
{
	 share = document.location.href;

	 c1 = document.getElementById("c1").checked;
	 c2 = document.getElementById("c2").checked;

	 if(c1) {
		  url = "http://www.facebook.com/share.php?u=" + share;
		  window.open(url,'fb_share');
	 }

	 if(c2) {

		  gurl = "https://plus.google.com/share?url=" + share;
		  window.open(gurl,'gp_share');
	 }
	 //alert('hello');
}
</script>
<style type="text/css">
div#pagenation {
   position: relative;
   overflow: hidden;
   font-size:0.9em;
}
div#pagenation ul {
	 position:relative;
	 left:50%;
	 float:left;
	 list-style: none;
}
div#pagenation li {
	 position:relative;

	 left:-50%;
	 float:left;
}
div#pagenation li a {
	 border:1px solid #CECECE;
	 margin: 0 3px;
	 padding:3px 7px;
	 display: block;
	 text-decoration:none;
	 color: #666666;
	 background: #fff;
}
div#pagenation li.active {
	 border:1px solid #CECECE;
	 margin: 0 3px;
	 padding:3px 7px;
	 display: block;
	 text-decoration:none;
	 color: #666666;
	 background: #ccc;

}
div#pagenation li a:hover{
	 border:solid 1px #666666;
	 color: #FFFFFF;
	 background: #3399FF;
}
</style>
</head>
<body>
<br />

<input type="button" onClick="Test();" value="test"/>
<br />
<input type="checkbox" value="1" name="c1" id="c1" /><label for="c1">facebook</label><br />
<input type="checkbox" value="1" name="c2" id="c2" /><label for="c2">google+</label><br />

<!--
<form action="http://jafmate.jp" method="post">
<input type="hidden" name="textfield" value="ju"/>
<input type="submit" name="submit" value="submit"/>
</form>
-->

<br /><br />
<h3>ページャーテスト</h3>

<?php
	 $count = count($data);
	 echo '<br />';
	 echo pager(10,$page,$count);
?>

<!--
<?php
echo '<pre>';
var_dump($_SERVER);
echo '</pre>';
?>
-->
</body>
</html>
