<?php

class AccessTokenAuthentication {
    function getTokens($authUrl, $scopeUrl, $clientID, $clientSecret){
        try {
            $headers = array('Ocp-Apim-Subscription-Key: '.$clientSecret);
            $postData = array(
				'grant_type' => 'client_credentials',
				'scope' => $scopeUrl,
				'client_id' => $clientID,
				'client_secret' => $clientSecret
			);

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $authUrl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, "{body}");
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); 

            $response = curl_exec($curl);

            $curlErrno = curl_errno($curl);
            if($curlErrno){
                $curlError = curl_error($curl);
                throw new Exception($curlError);
            }

            curl_close($curl);
            
            return $response;
            
        } catch (Exception $e) {
            echo "Exception-".$e->getMessage();
        }
    }
}

try {
    $clientID       = "wp-translate-box";
    $clientSecret = "28f3ccb2aafe4607ac8cbcc59e6faf8f";
    $authUrl      = "https://api.cognitive.microsoft.com/sts/v1.0/issueToken";
    $scopeUrl     = "http://api.microsofttranslator.com";

    $authObj      = new AccessTokenAuthentication();
    $accessToken  = $authObj->getTokens($authUrl, $scopeUrl, $clientID, $clientSecret);

    header("Content-Type: application/javascript");

    echo 'var lang = {};';
    echo "lang['ar'] = 'Arabic';";
    echo "lang['bg'] = 'Bulgarian';";
    echo "lang['ca'] = 'Catalan';";
    echo "lang['zh-CHS'] = 'Chinese (Simplified)';";
    echo "lang['zh-CHT'] = 'Chinese (Traditional)';";
    echo "lang['cs'] = 'Czech';";
    echo "lang['da'] = 'Danish';";
    echo "lang['nl'] = 'Dutch';";
    echo "lang['en'] = 'English';";
    echo "lang['et'] = 'Estonian';";
    echo "lang['fa'] = 'Persian (Farsi)';";
    echo "lang['fi'] = 'Finnish';";
    echo "lang['fr'] = 'French';";
    echo "lang['de'] = 'German';";
    echo "lang['el'] = 'Greek';";
    echo "lang['ht'] = 'Haitian Creole';";
    echo "lang['he'] = 'Hebrew';";
    echo "lang['hi'] = 'Hindi';";
    echo "lang['hu'] = 'Hungarian';";
    echo "lang['id'] = 'Indonesian';";
    echo "lang['it'] = 'Italian';";
    echo "lang['ja'] = 'Japanese';";
    echo "lang['ko'] = 'Korean';";
    echo "lang['lv'] = 'Latvian';";
    echo "lang['lt'] = 'Lithuanian';";
    echo "lang['mww'] = 'Hmong Daw';";
    echo "lang['no'] = 'Norwegian';";
    echo "lang['pl'] = 'Polish';";
    echo "lang['pt'] = 'Portuguese';";
    echo "lang['ro'] = 'Romanian';";
    echo "lang['ru'] = 'Russian';";
    echo "lang['sk'] = 'Slovak';";
    echo "lang['sl'] = 'Slovenian';";
    echo "lang['es'] = 'Spanish';";
    echo "lang['sv'] = 'Swedish';";
    echo "lang['th'] = 'Thai';";
    echo "lang['tr'] = 'Turkish';";
    echo "lang['uk'] = 'Ukrainian';";
    echo "lang['vi'] = 'Vietnamese';";

    echo 'window.mstranslator_accessToken = "'.$accessToken.'";';
    echo "window.mstranslator_langs = lang;";  

} catch (Exception $e) {
    echo "Exception: " . $e->getMessage() . PHP_EOL;
}
 
?>
