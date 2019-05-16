<?php
namespace allawitte\parser;
/**
 * @author Victor Zinchenko <zinchenko.us@gmail.com>
 */
class Parser implements ParserInterface
{

    public function process(string $url, string $tag):array
    {        
		$html = $this->getParserByCurl($url);
        preg_match_all('#<\s*?'.$tag.'.*?>(.+?)<\/'.$tag.'>#sui', $html, $res);
		return $res[0];
		
    }
	
	public function getParserByCurl($url){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		$result = curl_exec($curl);
		if ($result === false) {			echo "Ошибка CURL: " . curl_error($curl);
			return false;
		} else {
			return $result;
		}
	}
}