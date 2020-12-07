<h1>Polideportivo - Reservas</h1>
	</header>
	<div class="text-center p-t-100">
<?php

if ($this->seguridad->haySesionIniciada()) {
	echo "<p style='color:white';>Hola, " . $this->seguridad->get("nombre") . "</p>";
}
// Mostramos mensaje de error o de información (si hay alguno)
if (isset($data['msjError'])) {
	echo "<p style='color:white' id='msjError'>" . $data['msjError'] . "</p>";
} else {
	echo "<p style='color:white' id='msjError'></p>";
}
if (isset($data['msjInfo'])) {
	echo "<p style='color:white' id='msjInfo'>" . $data['msjInfo'] . "</p>";
} else {
	echo "<p style='color:white' id='msjInfo'></p>";
}


/*********************************************************************  CALENDARIO   **********************************************************************/


	$month = date("n");
    $year = date("Y");
    $diaActual = date("j");
    $diaSemana = date("w", mktime(0, 0, 0, $month, 1, $year)) + 7;
    $ultimoDiaMes = date("d", (mktime(0, 0, 0, $month + 1, 1, $year) - 1));
    $meses = array(1 => "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
		"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	
    ?>

            <table class='calendario'>

                <caption><?php echo $meses[$month] . " " . $year ?></caption>
                <tr>
                    <th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>
                    <th>Vie</th><th>Sab</th><th>Dom</th>
                </tr>
                

                    <?php
                    $last_cell = $diaSemana + $ultimoDiaMes;

                    for ($i = 1; $i <= 42; $i++) {

                        if ($i == ($diaSemana)) {

                            // determinamos en que dia empieza
                            $day = 1;
                        }

                        if ($i < $diaSemana || $i >= $last_cell) {

                            // celca vacia
                            echo "<td>&nbsp;</td>";
                        } else {

                            // mostramos el dia
                            if ($day == $diaActual){
								echo "<td>
								<a style='background:-webkit-linear-gradient(left, #6a11cb, #2575fc);border: 2px solid black;'
								href='index.php?action=formularioReserva&fecha=".$year."-".$month."-".$day."'
								class='botones'id='ano".$year."mes".$month."dia".$day."'>$day</a></td>";
								$day++;
							}
                            else { 
								echo "<td>
								<a style='background:none' href='index.php?action=formularioReserva&fecha=".$year."-".$month."-".$day."' 
								class='botones' id='ano".$year."mes".$month."dia".$day."'>$day</a><form></td>";
								$day++;
							}
                        }

                        // cuando llega al final de la semana, iniciamos una columna nueva

                        if ($i % 7 == 0) {

                            echo "<tr>\n";
                        }
                    }
                    ?>

                </tr>

			</table>
			<?php	
				$month += 1;
				if($month == 13) {
					$month = 1;
					$year += 1;
				}
				$diaSemana = date('w',$ultimoDiaMes)+8;
				
				
			?>
			<table class='calendario'>

                <caption><?php echo $meses[$month] . " " . $year ?></caption>
                <tr>
                    <th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>
                    <th>Vie</th><th>Sab</th><th>Dom</th>
                </tr>
                

                    <?php
                    $last_cell = $diaSemana + $ultimoDiaMes;

                    for ($i = 1; $i <= 42; $i++) {

                        if ($i == $diaSemana) {
                            // determinamos en que dia empieza
                            $day = 1;
                        }

                        if ($i < $diaSemana || $i >= $last_cell) {
                            // celca vacia
                            echo "<td>&nbsp;</td>";
                        } else {

							// mostramos el dia
							echo "<td>
								<a style='background:none' href='index.php?action=formularioReserva&fecha=".$year."-".$month."-".$day."' 
								class='botones' id='ano".$year."mes".$month."dia".$day."'>$day</a><form></td>";
								$day++;

							
							
							
							
                        }

                        // cuando llega al final de la semana, iniciamos una columna nueva

                        if ($i % 7 == 0) {

                            echo "<tr>\n";
                        } 
					}
					foreach ($data['listaReservas'] as $reserva) {
						$anoReserva = date('Y',strtotime($reserva->fecha));
						$mesReserva = date('n',strtotime($reserva->fecha));
						$diaReserva = date('j',strtotime($reserva->fecha));
							echo "<script>
								var dia = document.getElementById('ano".$anoReserva."mes".$mesReserva."dia".$diaReserva."');
								dia.style.background = '-webkit-linear-gradient(right, #01c90b, #9abfff)';
							</script>";
						
					}

                    ?>

                </tr>

			</table>
</div>