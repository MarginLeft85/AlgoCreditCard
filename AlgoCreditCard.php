<?php

$cardNumber = $number = '5018015112830366';
$patterns = [
    'Visa' => '/^4[0-9]{12}(?:[0-9]{3})?$/',
    'Mastercard' => '/^5[1-5][0-9]{14}$/',
    'Maestro' => '/^(5018|5020|5038|5893|6304|6759|6761|6762|6763)[0-9]{8,15}$/',
    'Doron' => '/^(14|81|99)[0-9]{12}$/',
    // Регулярные выражения для карт 
];

function regex_card_check($number, $patterns)
{
    global $cardtype;
    foreach ($patterns as $cardtype => $pattern) {
        if (preg_match($pattern, $number)) {
            return $cardtype;
        }
    }
    return false;
    
}
function luhnAlgorithm($number) {
    $number = strrev(preg_replace('/[^0-9]/', '', $number)); // Переворачиваем номер и удаляем все нецифровые символы
    $sum = 0;
 
    for ($i = 0, $length = strlen($number); $i < $length; $i++) {
        $digit = intval($number[$i]);
 
        if ($i % 2 === 1) {
            $digit *= 2;
            if ($digit > 9) {
                $digit -= 9;
            }
        }
 
        $sum += $digit;
    }
 
    return $sum % 10 === 0;
}
 

if (luhnAlgorithm($cardNumber)) {
    echo 'Номер карты валиден.';
} else {
    echo 'Номер карты невалиден.';
}

if (regex_card_check($cardNumber, $patterns)) {
    echo 'Это карта: ' .$cardtype;
} else {
    echo 'Такой карты не существует';
}
