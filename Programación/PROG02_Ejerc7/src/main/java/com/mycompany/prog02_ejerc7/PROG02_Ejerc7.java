/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 */

package com.mycompany.prog02_ejerc7;
import java.util.Scanner;

/**
 *
 * @author chris
 */
public class PROG02_Ejerc7 {

    public static void main(String[] args) {
         Scanner scanner = new Scanner(System.in);

        // Pedir al usuario que ingrese los coeficientes C1 y C2
        System.out.print("Ingrese el valor de C1: ");
        double C1 = scanner.nextDouble();

        System.out.print("Ingrese el valor de C2: ");
        double C2 = scanner.nextDouble();

        // Calcular la solución para x
        double x = -C2 / C1;

        // Mostrar el resultado con 4 decimales
        System.out.printf("La solución para x es: %.4f\n", x);
    }
}
