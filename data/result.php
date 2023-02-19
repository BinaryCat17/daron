<h1> Спасибо за пожертвование на излечение от PHP!</h1>
<img src='kek.jpg' width='400', height='200'>
<h2> Вы в пати!</h2>

<?php
class DaronKredit
{
    private $card = '';
    private $checksum = 0;

    public function inputCard($card) {
        $this->card = str_replace(' ', '', $card);

    }

    public function validate() {
        $len = strlen($this->card);
        if ($len < 16)
            return false;
        
        $check = 0;
        for ($i = $len - 1; $i >= 0; $i--) {
            $num = (int) $this->card[$i];

            if ($i % 2 == 0) {
                $num *= 2;
                if ($num > 9) {
                    $num -= 9;
                }
            }

            $check += $num;
        }
        $this->checksum = $check;
        return $check % 10 == 0;
    }

    public function checksum() {
        return $this->checksum;
    }

    public function emitter() {
        $visa = '/\A(4[0-9]|14)\d+/';
        $mastercard = '/\A(5[1-5]|62|67)\d+/';

        if (preg_match($visa, $this->card)) {
            return 'VISA';
        } else if (preg_match($mastercard, $this->card)) {
            return 'MASTERCARD';
        } else {
            return null;
        }
    }
}
?>

<?php
$bank = new DaronKredit();
$bank->inputCard($_POST['card']);
?>

<p> Проверяем карту <?php echo $_POST['card'] ?> </p>

<p><?php
if ($bank->validate()) {
    echo 'Карта валидна';
} else {
    echo 'Ложь, обман и провокация';
}
?></p>

<p>Контрольная сумма <?php echo $bank->checksum() ?>

<p><?php
$emit = $bank->emitter();

if ($emit !== null) {
    echo $emit;
} else {
    echo 'Эмитент карты не определён';
}
?></p>

<h1>Всё работает, вот пруфы</h1>

<img src='proof1.png' width='400', height='200'>
<img src='proof2.png' width='400', height='200'>
<img src='proof3.png' width='400', height='200'>
<img src='proof4.png' width='400', height='200'>