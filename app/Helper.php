<?php 

	namespace App;

	class Helper
	{

		public static function GenerateVideoEmbed($id) {
			return '//player.vimeo.com/video/'.$id.'?title=0&byline=0&portrait=0&sidedock=0';
		}

		public static function GenerateVimeoEmbed($url) {
			$regs = array();
    
	        $id = '';
	    
	        if (preg_match('%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $url, $regs)) {
	            $id = $regs[3];
	        }
	    
	        return $id;
		}

		public static function GenerateVideoThumb($video_url) {
	        $oembed_endpoint = 'http://vimeo.com/api/oembed';
	        $xml_url = $oembed_endpoint . '.xml?url=' . rawurlencode('https://vimeo.com/'.$video_url) . '&width=640';
	        function curl_get($url) {
	            $curl = curl_init($url);
	            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
	            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	            $return = curl_exec($curl);
	            curl_close($curl);
	            return $return;
	        }
	        
	        $oembed = simplexml_load_string(curl_get($xml_url));

	        return $oembed->thumbnail_url;
	    }
	}



 ?>