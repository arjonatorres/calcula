<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Calculadora</title>
    </head>
    <body>

        <?php $op1 = $op2 = $op = null;
        function selected(?string $o, string $v): string
        {
            return $o === $v ? 'selected': '';
        }

        extract($_GET, EXTR_IF_EXISTS);

        function calcula($op1, $op2, $op)
        {
            eval("\$ret = $op1 $op $op2;"); //Es peligroso, no usar.
            // switch ($op) {
            //     case '+':
            //         $ret = $op1 + $op2;
            //         break;
            //     case '-':
            //         $ret = $op1 - $op2;
            //         break;
            //     case '*':
            //         $ret =  $op1 * $op2;
            //         break;
            //     case '/':
            //         $ret =  $op1 / $op2;
            //         break;
            // }
            return $ret;
        }

        ?>
        <?php if(isset($op1, $op2, $op)): ?>
            <?php if (is_numeric($op1) && is_numeric($op2)): ?>
                <?php if ($op1 >= 0 && $op2 >= 0): ?>
                    <?php if (in_array($op, ['+', '-', '*', '/'])): ?>
                        <?php $op1 = calcula($op1, $op2, $op); ?>

                    <?php else: ?>
                        <h3>Error: Operador no válido.</h3>
                    <?php endif ?>
                <?php else: ?>
                    <h3>Error: Los dos operandos deben ser positivos.</h3>
                <?php endif ?>
            <?php else: ?>
                <h3>Error: Los dos operandos deben ser numéricos.</h3>
            <?php endif ?>
        <?php elseif ($op1 !== null || $op2 !== null || $op !== null): ?>
            <h3>Error: Falta algún parámetro.</h3>
        <?php endif ?>

        <form action="calcula.php" method="get">
            <label for="op1">Primer operando:</label>
            <input id="op1" type="text" name="op1" value="<?= $op1 ?>" /><br />
            <label for="op2">Segundo operando:</label>
            <input id="op2" type="text" name="op2" value="<?= $op2 ?>" /><br />
            <label for="op">Operación:</label>
            <select id="op" name="op">
                <option value="+" <?= selected($op, '+') ?> >sumar</option>
                <option value="-" <?= selected($op, '-') ?> >restar</option>
                <option value="*" <?= selected($op, '*') ?> >multiplicar</option>
                <option value="/" <?= selected($op, '/') ?> >dividir</option>
            </select><br />
            <input type="submit" value="Calcular" />
        </form>
    </body>
</html>
