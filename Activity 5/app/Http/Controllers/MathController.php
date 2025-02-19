<?php

namespace App\Http\Controllers; //pagdeklara ng Controllers

class MathController extends Controller
{
    public function compute($operation1, $val1, $val2)//dito ilalagay ang baryabol ng operasyon at ng dalawang numero
    {
        //Punsiyón para sa pagkuha ng operasyon, pagkuha ng mga baryable, pagdagdag, pagbawas, pagpaparami, at paghahati ng mga baryable
        function calculate($operation, $a, $b) { //dito ipinapahayag ang operasyon at baryable($a at $b) para sa pagkuha ng mga ilalagay na numero
            switch ($operation) { //ang ibig sabihin ng $operation ay kukuha ito ng case na 'add', 'subtract', 'multiply', at 'divide' na ang user ang maglalagay sa URL
                case 'add': //kapag 'add' ang inilagay ng user dito: http://domain/multiply/4/3/dito/2/3
                    return $a + $b; //ibabalik ang kabuuan
                case 'subtract': //kapag 'subtract' ang inilagay ng user dito: http://domain/multiply/4/3/dito/2/3
                    return $a - $b; //ibabalik ang pagkakaiba
                case 'multiply': // kapag 'multiply' ang inilagay ng user dito: http://domain/multiply/4/3/dito/2/3
                    return $a * $b; //ibabalik ang produkto
                case 'divide': // kapag 'divide' ang inilagay ng user dito: http://domain/multiply/4/3/dito/2/3
                    return $b != 0 ? $a / $b : 'Error: Cannot divide by zero'; // ibabalik ang kusyente
                default:
                    return 'Invalid operation'; //kapag wala sa mga pagpipilian ang inilagay ng user
            }
        }

        //pagdedeklara ng mga inilagay
        $result1 = calculate($operation1, $val1, $val2);

        //HTML syntax upang maipalabas sa UI
        header("Content-Type: text/html");
        echo "<h1>Jesus Emmanuel Llamas | 3B</h1>";//pangalan ng gumawa
        echo "<p>Value 1: $val1</p>";//dito ipapakita ang unang numero na galing sa calculate na punsiyon
        echo "<p>Value 2: $val2</p>";//dito ipapakita ang pangalawang numero na galing sa calculate na punsiyon
        echo "<p>Operator: $operation1</p>";//ipapakita ang ginamit na operasyon
        echo "<p>Result: <span style='display: inline-block; padding: 10px; border-radius: 5px; color:white; background-color:" . ($result1 % 2 == 0 ? 'green' : 'blue') . "'> $result1</span></p>";//dito ipapakita ang resulta sa dalawang numero na ginamitan ng operasyon, at dito rin magdedesisyon na magpapalit ng kulay ng background kung ang resulta ba ay pantay o kakaiba
    }
}

?>