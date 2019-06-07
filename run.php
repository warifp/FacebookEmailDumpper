<?php
/**
 * Author : Wahyu Arif Purnomo
 * Create : 7 Juni 2019
 * 
 * Please don't recode brother.
 */
error_reporting(0);

/** Banner */
echo "\e[1;91m=========================================================================\e[0m\r\n";
echo "                        \e[0;36m||\e[0m \e[45mFacebook Email Dumpper\e[0m \r\n";
echo "                        \e[0;36m||\e[0m \e[42m(c) 2019 WAHYU ARIF P\e[0m\r\n";
echo " \e[1;91m======================\e[0m \e[0;36m||\e[0m \r\n";
echo " \e[45mFACEBOOK EMAIL DUMPPER\e[0m \e[0;36m||\e[0m Facebook  : \e[0;34mhttps://www.facebook.com/warifp\e[0m\r\n";
echo "        [RAINBOW]       \e[0;36m||\e[0m Instagram : \e[0;34mhttps://www.instagram.com/warifp\e[0m\r\n";
echo " \e[1;91m======================\e[0m \e[0;36m||\e[0m Twitter   : \e[0;34mhttps://www.twitter.com/wahyuarifp\e[0m\r\n";
echo "                        \e[0;36m||\e[0m Github    : \e[0;34mhttps://www.github.com/warifp\r\n";
echo "\e[1;91m=========================================================================\e[0m\r\n\n";
echo "\e[1;36m[>] Usage \t\t: php namafile.php\e[0m\r\n";
echo "\e[1;36m[>] Result Email \t: result.txt\e[0m\r\n";
echo "\e[1;91m=========================================================================\e[0m\r\n";
echo "\e[42m[+] UPDATE : 07 Juni 2019\e[0m\r\n";
echo "\e[1;91m=========================================================================\e[0m\r\n\n";
echo "\e[0;34mStarting Facebook Email Dumpper..\e[0m";
sleep(3);echo "\n";
echo "\n";
/** End Banner */

/** Color  */
        include 'color.php';
		$colors = new Colors();
		$warifp = $colors->getForegroundColors();
/** End Color  */

/** Random Number  */
        $n=1; 
        function getName($n) { 
            $characters = '123456789'; 
            $randomString = ''; 
          
            for ($i = 0; $i < $n; $i++) { 
                $index = rand(0, strlen($characters) - 1); 
                $randomString .= $characters[$index]; 
            } 
          
            return $randomString; 
        } 
/** End Random Number  */

    echo "Masukan Token : ";
    $token = trim(fgets(STDIN));

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "https://graph.facebook.com/v3.2/me/friends/?fields=name,email&access_token=" . $token . "&limit=100");
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$get_friends = curl_exec($curl);
	curl_close($curl);
	
	$decode     = json_decode($get_friends);
    $total      = $decode->summary->total_count;
    echo "Total Teman :  " . $total . "\n";
    
//function get_email($token, $total){
    $curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "https://graph.facebook.com/v3.2/me/friends/?fields=name,email&access_token=" . $token . "&limit=" . $total);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$get_mail = curl_exec($curl);
    curl_close($curl);
    
    $decode = json_decode($get_mail);
    
    echo "\n\e[0;34mStarting Dump Email..\e[0m\n\n";
    sleep(3);
    $no = 0;
    $count = count($fgs);
    foreach ($decode->data as $hasil) {
        $no++;
        $colorstring = getName($n);
        if (!empty($hasil->email)) {
            //echo $no.". \e[0;36m" . $hasil->name . "\e[0m | \e[31;3mEmail : " . $hasil->email . "\e[0m\n";
            echo $no.".". $colors->getColoredString(" $hasil->name | $hasil->email", $warifp[$colorstring]) . "\n";
            $save = fopen('result.txt', 'a');
            fwrite($save, $hasil->name . "|" . $hasil->email . "\n");
            fclose($save);
        }
    }
//}
//get_email($token, $total);