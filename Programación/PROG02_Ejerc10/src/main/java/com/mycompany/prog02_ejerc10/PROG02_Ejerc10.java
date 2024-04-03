/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 */

package com.mycompany.prog02_ejerc10;

/**
 *
 * @author chris
 */
public class PROG02_Ejerc10 {

    public static void main(String[] args) {
        System.out.println("------- Conversiones entre enteros y coma flotante -------");
        float x = 4.5f;
        float y = 3.0f;
        int i = 2;
        int j;
        j = (int) (i * x);
        System.out.println("Producto de int por float: j = i * x = " + j);
        double dx = 2.0d;
        double dz;
        dz = dx * y;
        System.out.println("Producto de float por double: dz = dx * y = " + dz);

        int xy = (int)(2*x);
        
        System.out.println("\n------- Operaciones con byte -------");
        byte bx = 5;
        byte by = 2;
        byte bz;
        bz = (byte) (bx - by);
        System.out.println("byte: " + bx + " - " + by + " = " + bz);
        bx = -128;
        by = 1;
        bz = (byte) (bx - by);
        System.out.println("byte: " + bx + " - " + by + " = " + bz);
        int entero = (bx - by);
        System.out.println("(int)(" + bx + " - " + by + ") = " + entero);

        System.out.println("\n------- Operaciones con short -------");
        short sx = 5;
        short sy = 2;
        short sz = (short) (sx - sy);
        System.out.println("short: " + sx + " - " + sy + " = " + sz);
        sx = 32767;
        sy = 1;
        sz = (short) (sx + sy);
        System.out.println("short: " + sx + " + " + sy + " = " + sz);

        System.out.println("\n------- Operaciones con char -------");
        char cx = '\u000F';
        char cy = '\u0001';
        int z = (char) (cx - cy);
        System.out.println("char: " + cx + " - " + cy + " = " + z);
        z = ((int) cx) - 1;
        System.out.printf("char(%X) - 1 = %d\n", (int) cx, z);
        cx = '\uFFFF';
        z = cx;
        System.out.println("(int) cx = " + z);
        sx = (short) cx;
        System.out.println("(short) cx = " + sx);
        sx = -32768;
        cx = (char) sx;
        z = (int) sx;
        sx = (short) cx;
        System.out.println(z + " short-char-int = " + sx);
        sx = -1;
        cx = (char) sx;
        z = (int) cx;
        System.out.println(sx + " short-char-int = " + z);
    }
}
