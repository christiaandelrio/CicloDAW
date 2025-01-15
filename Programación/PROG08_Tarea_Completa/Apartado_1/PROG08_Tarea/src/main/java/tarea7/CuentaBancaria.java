/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package tarea7;

/**
 *
 * @author chris
 */
public abstract class CuentaBancaria implements Imprimible { //En el enunciado se nos dice que es abstracta, cosa que tenemos que indicar en la cabecera
    //Que sea abstracta significa que no se puede crear instancias de ella pero sirve de plantilla para sus clases hijas
    
    //Atributos de la clase CuentaBancaria
    private Persona titular; //titular es un objeto de la clase persona
    private double saldo;
    private String iban;

    public CuentaBancaria(Persona titular, double saldo, String iban) {
        this.titular = titular;
        this.saldo = saldo;
        this.iban = iban;
    }

    public Persona getTitular() {
        return titular;
    }

    public void setTitular(Persona titular) {
        this.titular = titular;
    }

    public double getSaldo() {
        return saldo;
    }

    public void setSaldo(double saldo) {
        this.saldo = saldo;
    }

    public String getIban() {
        return iban;
    }

    public void setIban(String iban) {
        this.iban = iban;
    }
       
    
    @Override
    public String devolverInfoString () {
       return "titular=" + titular + ", saldo=" + saldo + ", iban=" + iban;        
    }
}
