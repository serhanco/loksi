<?php
    $officePositiveCountries = array ("Albania", "Azerbaijan", "Bosnia And Herzegovina", "Bulgaria", "Georgia", "Germany", "Iraq", "Kazakhstan", "Kyrgyzstan", "Kosovo", "Macedonia", "Moldova", "Montenegro", "Romania", "Russia", "Serbia", "Ukraine", "Uzbekistan");
    
    foreach ($officePositiveCountries as $c) {
        echo $c . "</br>";
    }

    function getUserCountry() {
        // IP'yi ip-api'ye yollamak üzere RequestURL oluştur
        $userIp = $_SERVER['REMOTE_ADDR'];
        $access_key = 'T06BkzbO4KrHmsZ';
        $ch = curl_init('https://pro.ip-api.com/json/'.$userIp.'?fields=16385&key='.$access_key.'') or die('olmadı be');
        // Hazırlanan RequestURL'i CURL ile çağır
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);       
        // Request yanıtını decode et
        $api_result = json_decode($json, true);
        // Request başarılı dönüş yapmışsa
        if (isset($api_result['status']) && ($api_result['status'] === "success")) {
            //echo ' - Status: ' . $api_result['status'] . ', ' . 'Country: ' . $api_result['country'];
            $_SESSION['user_country'] = $api_result['country'];
            $user_country = $_SESSION['user_country'];
            
            ofisTelefonuGetir($user_country);

            if (in_array(ucwords($user_country), $ofisUlkeleri)) {
                //echo " - Listede var: " . $user_country;
                $_SESSION['ofis_ulkesi'] = true;
                //echo " - Ofis listesi: " . $_SESSION['ofis_ulkesi'];
            }
        }
    }
?>
