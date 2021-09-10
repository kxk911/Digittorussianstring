<?php

namespace Kxk911\Digittorussianstring;

class Digittorussianstring
{
    /**
     * Converter from digits to string (russian)
     * 
     * @param $digits int - digits
     * @return string 
     */
    public function toWord($digits){
        $digits = str_replace(',','.',$digits);
        if(is_numeric($digits)){
            $digitsArrray = explode('.', $digits);

            $digits = $digitsArrray[0];
            $ret_string = "";
            $sub_ret_string = "";

            for($i = 10; $i>=0; $i--){
                $pw = pow(1000,$i);
                
                if((int)($digits / $pw) != 0){
                    
                    $str = (int)($digits / $pw);
                   
                    if((strlen($str) - 3) == -1){
                        $sub_dig = substr($str, (strlen($str) - 2), 3);
                    }else{
                        $sub_dig = substr($str, (strlen($str) - 3), 3);
                    }
                    
                    $sub_len = strlen($sub_dig);
                     
                    $flag = false;
                    $sub_ret_string = "";
                    for($j=0; $j<$sub_len; $j++){
                        $post =  ($sub_len-1) - $j;

                        if($sub_len == 3){
                            if($j == 1 && $sub_dig[$j] == 1){
                                $ret_string .= $this->getDigitName( $sub_dig[$j].$sub_dig[$j+1], $post, $i).' ';
                                $sub_ret_string .= $sub_dig[$j].$sub_dig[$j+1];
                                $flag = true;
                            }
                            if(!$flag){
                                $ret_string .= $this->getDigitName( $sub_dig[$j], $post, $i).' ';
                                $sub_ret_string .= $sub_dig[$j];
                            }
                        }elseif($sub_len == 2){
                            if($j == 0 && $sub_dig[$j] == 1){
                                $ret_string .= $this->getDigitName( $sub_dig[$j].$sub_dig[$j+1], $post, $i).' ';
                                $sub_ret_string .= $sub_dig[$j].$sub_dig[$j+1];
                                $flag = true;
                            }
                            if(!$flag){
                                $ret_string .= $this->getDigitName( $sub_dig[$j], $post, $i).' ';
                                $sub_ret_string .= $sub_dig[$j];
                            }
                        }else{
                            $ret_string .= $this->getDigitName( $sub_dig[$j], $post, $i).' ';
                            $sub_ret_string .= $sub_dig[$j];
                        }
                    }
                    $ret_string .= $this->getTriolName($pw, $sub_ret_string).' ';
                }
            }
            $ret_string = $this->mb_ucfirst($ret_string);
            return [$ret_string, empty($digitsArrray[1])? "00":$digitsArrray[1]];
        }
        return ["0","00"];
    }

    /**
     * Function for getting triolies name
     * 
     * @param int $index - number of trionlies
     * @param int $val - value of triolies
     * @return string
     */
    public function getTriolName($index, $val){
        $triolies = [
            "1" =>  ["", "", ""],
            "1000" =>  ["тысяча", "тысячи", "тысяч"],
            "1000000" =>  ["миллион", "миллиона", "миллионов"],
            "1000000000" =>  ["миллиард","миллиарда", "миллиардов"],
            "1000000000000" =>  ["триллион","триллиона", "триллионов"],
            "1000000000000000" =>  ["квадрильон","квадрильона", "квадрильонов"],
            "1000000000000000000" =>  ["квинтильон","квинтильона", "квинтильонов"],
            "1000000000000000000000" =>  ["секстильон","секстильона", "секстильонов"],
        ];

        if($val == 0){
            return "";
        }

        if( strlen($val) > 1 && $val[strlen($val)-2] == 1 ){
            $val = $val[strlen($val)-2].$val[strlen($val)-1];
        }else{
            $val = $val[strlen($val)-1];
        }
        

        if($val == 1)
            return  $triolies[$index][0];
        if($val > 1 && $val < 5)
            return  $triolies[$index][1];
        if($val >= 5 || $val == 0)
            return  $triolies[$index][2];

    }

    /**
     * Function for getting digit name
     * 
     * @param int $digit - value of digit
     * @param int $position - value of digit position
     * @param int $iterator - value of triolies position
     * @return string
     */
    public function getDigitName($digit, $position, $iterator){
        $digits = [
            0 => [
                0 => "",
                1 => ["один","одна"],
                2 => ["два","две"],
                3 => "три",
                4 => "четыре",
                5 => "пять",
                6 => "шесть",
                7 => "семь",
                8 => "восемь",
                9 => "девять",
            ],
            1 => [
                0 => "",
                1 => "десять",
                2 => "двадцать",
                3 => "тридцать",
                4 => "сорок",
                5 => "пятьдесят",
                6 => "шестьдесят",
                7 => "семьдесят",
                8 => "восемьдесят",
                9 => "девяносто",
                10 => "десять",
                11 => "одинадцать",
                12 => "двенадцать",
                13 => "тринадцать",
                14 => "четырнадцать",
                15 => "пятнадцать",
                16 => "шестнадцать",
                17 => "семьнадцать",
                18 => "восемнадцать",
                19 => "девятнадцать",
            ],
            2 => [
                0 => "",
                1 => "сто",
                2 => "двести",
                3 => "тристо",
                4 => "четыресто",
                5 => "пятьсот",
                6 => "шестьсот",
                7 => "семьсот",
                8 => "восемьсот",
                9 => "девятьсот",
            ]
        ];
        $positionNew = $position;
        if($position > 3){
            $positionNew = $position % 3 ;
        }

        
        if($positionNew == 0 && $iterator == 1 && in_array($digit,[1,2]) ){
            return $digits[$positionNew][$digit][1];
        }else{
            if($positionNew == 0 && in_array($digit,[1,2]) ){
                return $digits[$positionNew][$digit][0];
            }else{
                return $digits[$positionNew][$digit];
            }
        }
       

    }

    /**
     * Function for upcase first character
     * 
     * @param string $str
     * @param string $env
     * @return string
     */
    private function mb_ucfirst($str, $enc = 'utf-8') {
        return mb_strtoupper(
            mb_substr($str, 0, 1, $enc), $enc).mb_substr($str, 1, mb_strlen($str, $enc), $enc);
    }
}
