/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 */

package com.mycompany.prog02_ejerc1;

/**
 *
 * @author chris
 */
public class PROG02_Ejerc1 {

    public static void main(String[] args) {
        //Valor máximo no modificable
        final int noModificable = 5000;
        
        //Tiene carnet o no
        boolean tieneCarnet = true;
        
        //Mes del año numérico y cadena
        String mesCadena = "Febrero";
        int mesNumerico = 2;
        
        //El nombre y apellidos de una persona
        String nombreApellidos = "Christian Del Río Lemos";
        
        //Sexo: con dos valores posibles 'V' o 'M'
        char sexo = 'V';
        
        //Milisegundos transcurridos desde el 01/01/1970 hasta hoy
        long miliSegundos = System.currentTimeMillis(); //Devuelve desde el uno de enero de 1970
        //long se usa para trabajar con números grandes
        
        //Saldo de una cuenta bancaria
        double saldoCuenta = 9750.87; //double nos permite trabajar con decimales
        
        double distanciaTierraJupiter = 628.73e6;
        
        System.out.println("Valor máximo no modificable: " + noModificable);
        System.out.println("¿Tiene carnet de conducir? " + tieneCarnet);
        System.out.println("Mes en formato numérico: " + mesNumerico);
        System.out.println("Mes en formato de cadena: " + mesCadena);
        System.out.println("Nombre completo: " + nombreApellidos);
        System.out.println("Sexo: " + sexo);
        System.out.println("Milisegundos desde 01/01/1970: " + miliSegundos);
        System.out.println("Saldo de la cuenta bancaria: " + saldoCuenta);
        System.out.println("Distancia Tierra-Júpiter en kms: " + distanciaTierraJupiter);
    }
}
