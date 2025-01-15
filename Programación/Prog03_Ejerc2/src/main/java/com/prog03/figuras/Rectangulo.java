/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 */

package com.prog03.figuras;

/**
 *
 * @author chris
 */
public class Rectangulo {

    private float base;  //Añado float para que admita números de coma flotante
    private float altura;
    private String color;    
    
    //Hacemos un constructor vacío que inicialice los atributos a 0
    public Rectangulo(){
        this.base = 0;
        this.altura = 0;
    }
    
    //Un constructor que inicialice base y altura
    public Rectangulo(float base, float altura){
        this.base = base;
        this.altura = altura;
    }
    
    //Métodos para actualizar y obtener el valor de cada atributo.
    public float getBase(){
        return base;
    }
    
    public void setBase(float base){
        this.base = base;
    }
    
    public float getAltura(){
        return altura;
    }
    
    public void setAltura(float altura){
        this.altura = altura;
    }
    
    //La función para obtener el área
    public float getArea() {
        return base * altura ;
    }
    
    public void setColor(String color) {
        this.color = color;
    }
    
    public String getColor() {
        return color;
    }
    
    @Override
    public String toString(){
        return "La base es " + getBase() + " y la altura es " + getAltura() + ". Área es igual a : " + getArea();
    }
    
    //Función para saber si es un cuadrado
    public boolean isCuadrado() {
        return base == altura; //Nos devuelve true si la base y altura son iguales, indicando que es un cuadrado
    }
    
    
}
