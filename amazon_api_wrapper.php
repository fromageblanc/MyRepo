<?php
require_once("modifier.class.php");
// Amazon
class AmazonApi implements Modifier
{
	// property
	private $auth;
	private $access_url = "http://ecs.amazonaws.jp/onca/xml";
	private $response;

	// constructer
	function __construct()
	{
		// 認証情報をセット
		$this->getAuth();
	}

	public function search($params)
	{
		$data = null;

		// common params -----------------------------------
		$p["Service"] = "AWSECommerceService";
		//$p["Version"] = "2009-10-01";
		$p["Version"] = "2011-08-02";
		$p["AssociateTag"] = $this->auth["associate_id"];
		$p["SignatureMethod"] = "HmacSHA256";
		$p["SignatureVersion"] = 2;

		// time zone (ISO8601 format)
		$p["Timestamp"] = gmdate("Y-m-d\TH:i:s\Z");

		$p["Operation"] = "ItemSearch";
		$p["SearchIndex"] = $params['Category'];
		if ( $p["SearchIndex"] != "All" ) {
			$p["Sort"] = "salesrank";
		}
		$p["Keywords"] = mb_convert_encoding($params['Keywords'],"utf-8","auto");
		$p["ResponseGroup"] = "ItemAttributes,Offers,Images";
		$p["ItemPage"] = (!empty($params['ItemPage'])) ? $params['ItemPage']:"1";
		// sort by asc
		ksort($p);

		$qstr = "AWSAccessKeyId=" .$this->auth['access_key'];
		foreach ( $p as $k=>$v ) {
			$qstr .= "&" .Common::urlencode_RFC3986($k). "=" .Common::urlencode_RFC3986($v);
		}

		$parsed_url = parse_url($this->access_url);
		$string_to_sign = "GET\n{$parsed_url['host']}\n{$parsed_url['path']}\n{$qstr}";
		$signature = base64_encode(
									hash_hmac('sha256', 
												$string_to_sign, 
												$this->auth['secret_access_key'], 
												true)
									);

		$url = $this->access_url.'?'.$qstr.'&Signature='.Common::urlencode_RFC3986($signature);

//	    $data = file_get_contents($url);

$data = $url;
/*
   		if($data==false){
	        echo "request failed.";
	    }
*/
		// for test return url
		$this->response = $data;
	}

	public function searchById($id)
	{
		// common params -----------------------------------
		$p["Service"] = "AWSECommerceService";
		//$p["Version"] = "2009-10-01";
		$p["Version"] = "2011-08-02";
		$p["ItemId"] = $id;
		$p["AssociateTag"] = $this->auth["associate_id"];
		$p["SignatureMethod"] = "HmacSHA256";
		$p["SignatureVersion"] = 2;

		// time zone (ISO8601 format)
		$p["Timestamp"] = gmdate("Y-m-d\TH:i:s\Z");

		$p["Operation"] = "ItemLookup";
		/*
		$p["SearchIndex"] = $params['Category'];
		if ( $p["SearchIndex"] != "All" ) {
			$p["Sort"] = "salesrank";
		}
		$p["Keywords"] = mb_convert_encoding($params['Keywords'],"utf-8","auto");
		*/
		$p["ResponseGroup"] = "ItemAttributes,Offers,Images";

		// sort by asc
		ksort($p);

		$qstr = "AWSAccessKeyId=" .$this->auth['access_key'];
		foreach ( $p as $k=>$v ) {
			$qstr .= "&" .Common::urlencode_RFC3986($k). "=" .Common::urlencode_RFC3986($v);
		}

		$parsed_url = parse_url($this->access_url);
		$string_to_sign = "GET\n{$parsed_url['host']}\n{$parsed_url['path']}\n{$qstr}";
		$signature = base64_encode(
									hash_hmac('sha256', 
												$string_to_sign, 
												$this->auth['secret_access_key'], 
												true)
									);

		$url = $this->access_url.'?'.$qstr.'&Signature='.Common::urlencode_RFC3986($signature);

//	    $data = file_get_contents($url);

$data = $url;
/*
   		if($data==false){
	        echo "request failed.";
	    }
*/
		// for test return url
		$this->response = $data;

	}

	public function response()
	{
		// xmlを配列にパース
		//return simplexml_load_string($this->response);
		// for test
		return $this->response;
	}

	private function getAuth()
	{
		// api_authから認証情報を取得 
		// ほんとはＤＢから
		$this->auth["associate_id"] = 'kangaroonote-22';
		$this->auth["access_key"] = 'AKIAJU6BB3NXANG4LDWA';
		$this->auth["secret_access_key"] = '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';
	}
}
?>
