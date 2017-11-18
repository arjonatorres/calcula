<?php

function seleccion(array $elementos, ?string $actual, $nombre): void
{
?>
    <select id="<?= $nombre ?>" name="<?= $nombre ?>">
        <?php
        foreach ($elementos as $v) {
            option($actual, $v);
        }
    ?>
    </select>
<?php
}

function option($op, $v)
{ ?>
    <option value="<?= $v ?>" <?= selected($op, $v) ?> >
        <?= $v ?>
    </option>
<?php
}

function selected(?string $o, string $v): string
{
    return $o === $v ? 'selected': '';
}


$op1 = $op2 = $op = null;
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
