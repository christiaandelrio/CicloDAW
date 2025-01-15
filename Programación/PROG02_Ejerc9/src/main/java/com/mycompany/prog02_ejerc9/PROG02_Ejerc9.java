/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 */

package com.mycompany.prog02_ejerc9;
import java.util.Scanner;
/**
 *
 * @author chris
 */
public class PROG02_Ejerc9 {

    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        // Pedir al usuario que ingrese el año
        System.out.print("Ingrese un año: ");
        int year = scanner.nextInt();

        // Determinar si el año es bisiesto o no
        boolean esBisiesto = false;

        if ((year % 4 == 0 && year % 100 != 0) || (year % 400 == 0)) {
            esBisiesto = true;
        }

        // Mostrar el resultado
        if (esBisiesto) {
            System.out.println(year + " es un año bisiesto.");
        } else {
            System.out.println(year + " no es un año bisiesto.");
        }
    }
}

