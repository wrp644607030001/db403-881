<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dices Roller</title>
</head>
<body>

    <?php
        function diceRoller($score = false) {
            $d1 = rand(1, 6);
            $d2 = rand(1, 6);
            $sum = $d1 + $d2;
            $mid = $score ? "$d1 + $d2 => " : '';
            return '2 Dices roll => '.$mid.' ผลรวมคือ ' .$sum;

        }

        echo '<h3>without score</h3>'; 
        echo diceRoller();
        echo '<h3>with score</h3>'; 
        echo diceRoller(true);
    ?>
</body>
</html>