<?php
	// Obtenemos todos los datos necesarios de la fecha actual
	$diaSemana = date("w");					// Día de la semana (en número)
	if ($diaSemana == 0) $diaSemana = 7;	// (Lo ajustamos para que Lunes sea 1 y Domingo sea 7)
	$diaMes = date("j");					// Día del mes (en número)
	$mes = date("n");						// Mes (en número). Enero = 1 y Diciembre = 12
	$nombreMes = date("F");					// Nombre del mes (en inglés. Si lo quieres en castellano, tendrás que hacerte un switch)
	$ano = date("Y");						// Año actual (en número)
	// Este echo solo tiene propósitos de depuración
    	echo "<p>Día de la semana: $diaSemana, día del mes: $diaMes, mes: $mes, nombre mes: $nombreMes, año: $ano</p>";

	// Calculamos en qué día de la semana empezó el mes actual
	// diaMes / 7 nos dice la semanas que han transcurrido desde el inicio del mes. Lo que sobre
	// (es decir, diaMes % 7) son el "pico" de días que sobran de la primera semana
	$picoDias = $diaMes % 7 + 1; 		
	// El mes empezó en el mismo día de la semana que es hoy restándole ese pico de días
	$diaSemanaEmpiezaMes = $diaSemana - $picoDias;
	// Si la resta nos diera negativo o 0, lo corregimos para que dé positivo
	if ($diaSemanaEmpiezaMes < 1) $diaSemanaEmpiezaMes = $diaSemanaEmpiezaMes + 7;
	// Este echo solo tiene propósitos de depuración
	echo "<p>Pico de días: $picoDias. El mes empezó en $diaSemanaEmpiezaMes</p>";

	// Ya tenemos todos los datos. Vamos a generar la tabla con el mes actual
	echo "<table border='1'>";
	echo "<tr><td colspan='7'>$nombreMes $ano</td></tr>";
	echo "<tr><td>L</td><td>M</td><td>X</td><td>J</td><td>V</td><td>S</td><td>D</td></tr><tr>";
	
	$diaM = 0;		// Contador para el día del mes. Irá de 0 al número de días del mes
	$diaS = 1;		// Contador para el día de la semana. Irá de 1 a 7 y volverá a empezar.
	$diasEnMes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);	// Días del mes actual. Tiene en cuenta los bisiestos
	
	while ($diaM <= $diasEnMes) {
			// Las primeras celdas de la tabla puede que estén vacías, hasta que lleguemos al día de la semana
			// en el que empezó el mes. Cuando eso ocurra, ponemos $diaM a 1
			if ($diaS == $diaSemanaEmpiezaMes && $diaM == 0) {
				$diaM = 1;
			}
			// Si $diaM es mayor que cero, imprimimos el número del día y pasamos al siguiente
			if ($diaM > 0)	{
				echo "<td>$diaM</td>";
				$diaM++;
			}
			// Si $diaM aún es cero, es que no hemos llegado al primer día del mes. Imprimimos una celda vacía
			else {
				echo "<td></td>";
			}
			// Incrementamos el día de la semana
			$diaS++;
			// Si hemos sobrepasado el domingo (7), pasamos a la siguiente fila de la tabla y
			// volvemos a poner la variable a lunes (1)
			if ($diaS > 7) {
				echo "</tr><tr>";
				$diaS = 1;
			}
	}
	echo "</tr></table>";
