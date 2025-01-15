/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 */

package com.mycompany.prog02_ejerc6;

/**
 *
 * @author chris
 */
public class PROG02_Ejerc6 {
    
    enum razas {
        Mastín,
        Terrier,
        Bulldog,
        Pekines,
        Caniche,
        Galgo;
    }

    public static void main(String[] args) {
        razas primer_perro = razas.Terrier;
        razas var2 = razas.Galgo;
        
        if (primer_perro == var2) {
            System.out.println("Las razas de perro son iguales.");
        } else {
            System.out.println("Las razas de perro son diferentes.");
        }
    }
}
