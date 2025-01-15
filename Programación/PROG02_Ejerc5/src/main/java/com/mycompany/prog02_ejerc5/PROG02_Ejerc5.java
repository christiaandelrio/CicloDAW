/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 */

package com.mycompany.prog02_ejerc5;

/**
 *
 * @author chris
 */
public class PROG02_Ejerc5 {

    public static void main(String[] args) {
        int segundos = 455647383;
        
        int dias = segundos / 86400;
        
        int segundos_restantes = segundos % 86400;
        
        int horas = segundos_restantes / 3600;
        
        segundos_restantes = segundos_restantes % 3600;
        
        int minutos = segundos_restantes % 60;
        
        System.out.println("Dias: " + dias);
        System.out.println("Horas: " + horas);
        System.out.println("Minutos: " + minutos);
    }
}
