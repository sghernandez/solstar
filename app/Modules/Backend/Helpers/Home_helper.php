<?php
/*
  -------------------------------------------------------------------
  Nombre: asigna_color
  -------------------------------------------------------------------
  Descripción:
  Asigna colores de acuerdo a un valor de porcentaje
  -------------------------------------------------------------------
  Entradas: 
  *porcentaje = Arreglo con los porcentajes
  *valoracion = Arreglo con + o -  (+ para notacion positiva, - para negativa)

* Los umbrales se definen en App_Config
  -------------------------------------------------------------------
  Salida: Regresa el color respectivo en un arreglo.
  -------------------------------------------------------------------
 */

function asigna_color ($porcentaje,$valoracion)
{
$color=[];
for ($i=0;$i<sizeof($porcentaje);$i++)
	{
	if ($porcentaje[$i]< config('AppConfig')->Barra_bajo)
		{
		$color[$i]=($valoracion[$i]=='+') ? 'red' : 'green';
		}
	if ($porcentaje[$i]<= config('AppConfig')->Barra_medio AND $porcentaje[$i] > config('AppConfig')->Barra_bajo)
		{
		$color[$i]='orange';
		}
	if ($porcentaje[$i] > config('AppConfig')->Barra_medio)
		{
		$color[$i]= ($valoracion[$i]=='+') ? 'green' : 'red';
		}
	}
	return $color;
}
