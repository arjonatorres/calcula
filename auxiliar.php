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

function compruebaParametros($op1, $op2, $op, array &$error): void
{
    // Si los tres parámetros están en la URL...
    if(isset($op1, $op2, $op)) {
        // Si algún operando es vacío...
        if ($op1 === '' || $op2 === '') {
            $error[] = 'Falta algún parámetro';
            throw new Exception;
        }
        // Están los tres parámetros y no son vacíos
        return;
    }
    // Si falta algún parámetro en la URL, pero no todos...
    if ($op1 !== null || $op2 !== null || $op !== null) {
        $error[] = 'Falta algún parámetro';
    }
    // Si falta todos los parámetros en la URL
    throw new Exception;
}

function compruebaOperador($op, array $lista, array &$error): void
{
    if (!in_array($op, $lista)) {
        $error[] = 'Operación no válida';
    }
}

function compruebaOperandos($op1, $op2, array &$error): void
{
    if (!is_numeric($op1) || !is_numeric($op2)) {
        $error[] = 'Los dos operandos deben ser numéricos';
    } elseif ($op1 < 0 || $op2 < 0) {
        $error[] = 'Los dos operandos deben ser positivos';
    }
}

function compruebaErrores(array $error)
{
    if (!empty($error)) {
        throw new Exception;
    }
}

function mostrarErrores($error)
{
    foreach ($error as $v):
    ?>
        <h3>Error: <?= $v ?>.</h3>
    <?php
    endforeach;
}

function dibujaFormulario($op1, $op2, $op, array $lista): void
{
?>
    <form action="calcula.php" method="get">
        <label for="op1">Primer operando:</label>
        <input id="op1" type="text" name="op1" value="<?= htmlentities($op1) ?>" /><br />
        <label for="op2">Segundo operando:</label>
        <input id="op2" type="text" name="op2" value="<?= htmlentities($op2) ?>" /><br />
        <label for="op">Operación:</label>
        <?php seleccion($lista, $op, 'op') ?><br />
        <input type="submit" value="Calcular" />
    </form>
<?php
}
