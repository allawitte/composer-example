<?php

require_once 'ParserInterface.php';
//require_once 'phpquery/phpQuery/phpQuery.php';
require_once __DIR__ . '/../vendor/autoload.php';
namespace allawitte\parser;


/**
 * @author Victor Zinchenko <zinchenko.us@gmail.com>
 */
class Parser implements ParserInterface
{

    public function process(string $url, string $tag):array
    {        
		$html = $this->getParserByCurl($url);
		//$pq = phpQuery::newDocument($html);
		$pq = phpQuery::newDocument($html);
		$links = $pq->find($tag);		
		$parsedLinks = [];
		foreach ($links as $link){			
			$elem = pq($link);
			$parsedLinks[]= ['text' => $elem->text(), 'href' => $elem->attr('href')];
					
		}
		return $parsedLinks;
		
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
