<?php
include('header.php');
   include('festivos.php');



   $festivo = new festivos();

$monthi = "";

$defecto = getdate();

$mes = $defecto['mon'];

$an = $defecto["year"];

//add to actual month
if(isset($_POST['month']) && $_POST['month'] != '')

   $monthi = $_POST['month'];

elseif(isset($_GET['newmonth']) && $_GET['newmonth'] != '')

       $monthi = $_GET['newmonth'];

elseif(isset($_GET['prevmonth']) && $_GET['prevmonth'] != '')

       $monthSel = $_GET['prevmonth'];

else

	$monthSel =  $mes;

if(isset($_POST['year']) && $_POST['year'] != '')

   $yearSel = $_POST['year'];

elseif(isset($_GET['newyear']) && $_GET['newyear'] != '')

	$yearSel = $_GET['newyear'];

elseif(isset($_GET['prevyear']) && $_GET['prevyear'] != '')

       $yearSel = $_GET['prevyear'];

else

	$yearSel =  $an;

    if (isset($_GET['prevmonth'],$_GET['prevyear'])) {

	  	$monthi = $_GET['prevmonth'];

	    $yeari =  $_GET['prevyear'];

	  }

      if (isset($_GET['newmonth'],$_GET['newyear'])) {

	  	 $monthi = $_GET['newmonth'];

	     $yeari =  $_GET['newyear'];

	  }



	   if( $monthi == "" OR $yeari == "" ){

	   	$Fecha=getdate();

        $monthi = $Fecha["mon"];

	   	$yeari = $Fecha["year"];

        $dae = cal_days_in_month (CAL_GREGORIAN,$monthi,$yeari).'<br>';

        $day = 	jddayofweek (cal_to_jd(CAL_GREGORIAN,$monthi,date("1"),$yeari), 0).'<br>';

	 }else{

      /*funcion que sacara los  dias del mes*/
	  $dae = cal_days_in_month (CAL_GREGORIAN,$monthi,$yeari).'<br>';

	  /*funcion que sacara el dia de la semana en que empezara el mes*/
      $day = jddayofweek ( cal_to_jd(CAL_GREGORIAN,$monthi,date("1"),$yeari), 0).'<br>';

	 }

	 if($monthi == 5 && $yeari== 2011){

	 	$d ='May 1 2011';

	 	$day = (date("w",strtotime($d))+7);

	   //tabla para mostrar el mes el ao y los controles para pasar al mes anterior y siguiente
      echo '<p>
               <table>

      <tr>

       <td>';

     //calculo el mes y ano del mes anterior
      $previous_Month = $monthi - 1;

      $previous_year = $yeari;

 if ($previous_Month == 0){

     $previous_year--;

     $previous_Month=12;
 }



   echo '<a href="calendar.php?prevmonth='.$previous_Month.'&prevyear='.$previous_year.
        '"><font face="Comic Sans MS" color="black"> <<< </font></a></td>';



   echo '<td>' .
         '' .
         date('M ').'&nbsp;'.$yeari.
         '' .
         '</td><td>';

     //calculo el mes y anio del mes siguiente
 $nextmonth = $monthi + 1;

 if ($nextmonth == 13){

    $yeari++;

    $nextmonth=1;

 }

   echo ' <a href="calendar.php?newmonth=' .$nextmonth. '&newyear='.$yeari.
        '"><font face="Comic Sans MS" color="black">  >>>  </font></a></td>';

//finalizo la tabla de cabecera
echo '</tr></table> </p>';
}




     /*se construye una tabla general*/
   echo ' <p>
             <table class="common-table" ';

    echo '<tr><td class="tit">';

    
echo '</td></tr>';

//fila con todos los días de la semana
echo '<tr >' .
      '
      <thead>
        <th class="diasemana"><font face="Comic Sans MS" color="black"><span>Monday</span></font></th>
         <th class="diasemana"><font face="Comic Sans MS" color="black"><span>Tuesday</span></font></th>
         <th class="diasemana"><font face="Comic Sans MS" color="black"><span>Wednesday</span></font></th>
         <th class="diasemana"><font face="Comic Sans MS" color="black"><span>Thursday</span></font></th>
         <th class="diasemana"><font face="Comic Sans MS" color="black"><span>Friday</span></font></th>
         <th class="diasemana"><font face="Comic Sans MS" color="black"><span>Saturday</span></font></th>
         <th class="diasemana"><font face="Comic Sans MS" color="black"><span>Sunday</span></font></th>
         </thead>
      </tr>';




$current_day=1;


/*ciclo para empesar a poner los dias en la tabla*/
echo "<tr>";

for ($i=1;$i<=7;$i++){

   if ($i < $day){
   	  //si el dia de la semana i es menor que el numero del primer dia de la semana no pongo nada en la celda
      echo '<td   class="diainvalido"><span></span></td>';
   } else {
      echo '<td class="diavalido"><font face="Comic Sans MS" color="black"><span>'.$current_day.'</span></font></td>';
     $current_day++;
   }


}
echo "</tr>";


$numberOfDay = 0;
while ($current_day <= $dae){

   //si estamos a principio de la semana escribo el <TR>
   if ($numberOfDay == 0)

      echo "<tr>";

   echo '<td  class="diavalido"><font face="Comic Sans MS" color="black"><span>' . $current_day . '</span></font></td>';

   $current_day++;
   $numberOfDay++;

   //si es el utimo de la semana, me pongo al principio de la semana y escribo el </tr>

   if ($numberOfDay == 7){

      $numberOfDay = 0;

      echo "</tr>";
   }

}
echo "</table> </p>";
include ('footer.php');

  ?>