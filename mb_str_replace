
/* 日本語対応str_replace */
function mb_str_replace($search, $replace, $haystack, $encoding="UTF-8")
{
                $notArray = !is_array($haystack) ? TRUE : FALSE;
                $haystack = $notArray ? array($haystack) : $haystack;
                $search_len = mb_strlen($search, $encoding);
                $replace_len = mb_strlen($replace, $encoding);
                foreach ($haystack as $i => $hay){
                                $offset = mb_strpos($hay, $search);
                                while ($offset !== FALSE){
                                                $hay = mb_substr($hay, 0, $offset).$replace.mb_substr($hay, $offset + $search_len);
                                                $offset = mb_strpos($hay, $search, $offset + $replace_len);
                                }
                                $haystack[$i] = $hay;
                }
                return $notArray ? $haystack[0] : $haystack;
}

$search = "あいうえお";
$replace = "かきくけこ";

var_dump(mb_str_replace($search,$replace,"あいうえお","UTF-8")); // かきくけこ
