/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 */

package com.mycompany.prog04_ejerc2;

/**
 *
 * @author chris
 */
import java.util.Scanner;

public class PROG04_Ejerc2 {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        for (int i = 0; i < 5; i++) {
            System.out.print("Ingrese un número: ");
            int numero = scanner.nextInt();

            if (numero < 0) {
                System.out.println("El número es negativo.");
            } else {
                if (esPrimo(numero)) {
                    System.out.println("El número es primo.");
                } else {
                    System.out.println("El número no es primo.");
                }
            }
        }
    }

    private static boolean esPrimo(int numero) {
        if (numero <= 1) {
            return false;
        }
        for (int i = 2; i <= Math.sqrt(numero); i++) {
            if (numero % i == 0) {
                return false;
            }
        }
        return true;
    }
}
