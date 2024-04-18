/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/javafx/FXMLController.java to edit this template
 */
package chris.prog10_tarea;

import java.net.URL;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Button;
import javafx.scene.control.TextField;

/**
 * FXML Controller class
 *
 * @author chris
 */
public class CalculadoraController implements Initializable {

    @FXML
    private Button btn7;
    @FXML
    private Button btn8;
    @FXML
    private Button btn9;
    @FXML
    private Button btn4;
    @FXML
    private Button btn5;
    @FXML
    private Button btn6;
    @FXML
    private Button btn1;
    @FXML
    private Button btn2;
    @FXML
    private Button btn3;
    @FXML
    private Button btn0;
    @FXML
    private Button btnPlus;
    @FXML
    private Button btnMinus;
    @FXML
    private Button btnBy;
    @FXML
    private Button btnC;
    @FXML
    private Button btnCE;
    @FXML
    private Button btnDivided;
    @FXML
    private Button btnEqual;
    @FXML
    private TextField txtResult;

    private int resultado;
    private boolean primerOperando;
    private boolean limpiarTexto;
    private boolean sePuedeCalcular;
    private char ultimoOperador;

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        this.primerOperando = true;
        this.resultado = 0;
        this.limpiarTexto = true;
        this.sePuedeCalcular = false;
    }

    @FXML
    private void clickbtn7(ActionEvent event) {

        if (this.limpiarTexto) {
            this.txtResult.setText("7");
            this.limpiarTexto = false;
        } else {
            this.txtResult.appendText("7");
        }
        this.sePuedeCalcular = true;
    }

    @FXML
    private void clickbtn8(ActionEvent event) {
        if (this.limpiarTexto) { //La primera vez que hago click escribe un 8
            this.txtResult.setText("8");
            this.limpiarTexto = false;  //Se vuelve false
        } else {
            this.txtResult.appendText("8");   //Si vuelvo a poner otro escribiría 88          
        }
        this.sePuedeCalcular = true;
    }

    @FXML
    private void clickbtn9(ActionEvent event) {
        if (this.limpiarTexto) {
            this.txtResult.setText("9");
            this.limpiarTexto = false;
        } else {
            this.txtResult.appendText("9");
        }
        this.sePuedeCalcular = true;
    }

    @FXML
    private void clickbtn4(ActionEvent event) {
        if (this.limpiarTexto) {
            this.txtResult.setText("4");
            this.limpiarTexto = false;
        } else {
            this.txtResult.appendText("4");
        }
        this.sePuedeCalcular = true;
    }

    @FXML
    private void clickbtn5(ActionEvent event) {
        if (this.limpiarTexto) {
            this.txtResult.setText("5");
            this.limpiarTexto = false;
        } else {
            this.txtResult.appendText("5");
        }
        this.sePuedeCalcular = true;
    }

    @FXML
    private void clickbtn6(ActionEvent event) {
        if (this.limpiarTexto) {
            this.txtResult.setText("6");
            this.limpiarTexto = false;
        } else {
            this.txtResult.appendText("6");
        }
        this.sePuedeCalcular = true;
    }

    @FXML
    private void clickbtn1(ActionEvent event) {
        if (this.limpiarTexto) {
            this.txtResult.setText("1");
            this.limpiarTexto = false;
        } else {
            this.txtResult.appendText("1");
        }
        this.sePuedeCalcular = true;
    }

    @FXML
    private void clickbtn2(ActionEvent event) {
        if (this.limpiarTexto) {
            this.txtResult.setText("2");
            this.limpiarTexto = false;
        } else {
            this.txtResult.appendText("2");
        }
        this.sePuedeCalcular = true;
    }

    @FXML
    private void clickbtn3(ActionEvent event) {
        if (this.limpiarTexto) {
            this.txtResult.setText("3");
            this.limpiarTexto = false;
        } else {
            this.txtResult.appendText("3");
        }
        this.sePuedeCalcular = true;
    }

    @FXML
    private void clickbtn0(ActionEvent event) {
        if (this.limpiarTexto) {
            this.txtResult.setText("0");
            this.limpiarTexto = false;
        } else {
            this.txtResult.appendText("0");
        }
        this.sePuedeCalcular = true;
    }

    @FXML
    private void clickbtnPlus(ActionEvent event) {
        if (this.sePuedeCalcular) {  //Si se ha pulsado un núm, será true y por tanto permitirá sumar, pero hasta que se pulse otro no se podrá de nuevo
            if (this.primerOperando) { //Si es el primer número que introducimos
                this.resultado = Integer.parseInt(this.txtResult.getText()); //Metemos en el resultado el valor del botón pulsado, haciendo la conversión a Integer correspondiente
            } else {
                this.resultado += Integer.parseInt(this.txtResult.getText()); //Si no es el primero le sumamos al valor que ya tenga resultado
            }

            this.txtResult.setText(this.resultado + "");//Hay que poner las comillas para evitar error de tipos
            this.primerOperando = false;
            this.limpiarTexto = true; //Al hacer click en + se reinicia para que en vez de usar appendText use setText y ponga en el recuadro el núm que se acaba de pulsar
            this.sePuedeCalcular = false;

        }
        this.ultimoOperador = '+';        
    }

    @FXML
    private void clickbtnMinus(ActionEvent event) {
        if (this.sePuedeCalcular) {  //Si se ha pulsado un núm, será true y por tanto permitirá sumar, pero hasta que se pulse otro no se podrá de nuevo
            if (this.primerOperando) { //Si es el primer número que introducimos
                this.resultado = Integer.parseInt(this.txtResult.getText()); //Metemos en el resultado el valor del botón pulsado, haciendo la conversión a Integer correspondiente
            } else {
                this.resultado -= Integer.parseInt(this.txtResult.getText()); //Si no es el primero le sumamos al valor que ya tenga resultado
            }

            this.txtResult.setText(this.resultado + "");//Hay que poner las comillas para evitar error de tipos
            this.primerOperando = false;
            this.limpiarTexto = true; //Al hacer click en + se reinicia para que en vez de usar appendText use setText y ponga en el recuadro el núm que se acaba de pulsar
            this.sePuedeCalcular = false;

        }
        this.ultimoOperador = '-';        
    }

    @FXML
    private void clickbtnBy(ActionEvent event) {
        if (this.sePuedeCalcular) {  //Si se ha pulsado un núm, será true y por tanto permitirá sumar, pero hasta que se pulse otro no se podrá de nuevo
            if (this.primerOperando) { //Si es el primer número que introducimos
                this.resultado = Integer.parseInt(this.txtResult.getText()); //Metemos en el resultado el valor del botón pulsado, haciendo la conversión a Integer correspondiente
            } else {
                this.resultado *= Integer.parseInt(this.txtResult.getText()); //Si no es el primero le sumamos al valor que ya tenga resultado
            }

            this.txtResult.setText(this.resultado + "");//Hay que poner las comillas para evitar error de tipos
            this.primerOperando = false;
            this.limpiarTexto = true; //Al hacer click en + se reinicia para que en vez de usar appendText use setText y ponga en el recuadro el núm que se acaba de pulsar
            this.sePuedeCalcular = false;

        }
            this.ultimoOperador = '*';        
    }

    @FXML
    private void clickbtnC(ActionEvent event) {
        this.txtResult.setText("");
        this.primerOperando = false;
        this.limpiarTexto = true;
        this.sePuedeCalcular = false;
    }

    @FXML
    private void clickbtnCE(ActionEvent event) {
        this.txtResult.setText("");
        this.resultado = 0;
        this.primerOperando = true; //Lo reiniciamos porque vuelve a empezar
        this.limpiarTexto = true; //Escribe el primer número
        this.sePuedeCalcular = false; //No va a hacer nada hasta que se pulse un número de nuevo
    }

    @FXML
    private void clickbtnDivided(ActionEvent event) {
        if (this.sePuedeCalcular) {  //Si se ha pulsado un núm, será true y por tanto permitirá sumar, pero hasta que se pulse otro no se podrá de nuevo
            if (this.primerOperando) { //Si es el primer número que introducimos
                this.resultado = Integer.parseInt(this.txtResult.getText()); //Metemos en el resultado el valor del botón pulsado, haciendo la conversión a Integer correspondiente
            } else {
                this.resultado /= Integer.parseInt(this.txtResult.getText()); //Si no es el primero le sumamos al valor que ya tenga resultado
            }

            this.txtResult.setText(this.resultado + "");//Hay que poner las comillas para evitar error de tipos
            this.primerOperando = false;
            this.limpiarTexto = true; //Al hacer click en + se reinicia para que en vez de usar appendText use setText y ponga en el recuadro el núm que se acaba de pulsar
            this.sePuedeCalcular = false;

        }
            this.ultimoOperador = '/';        
    }

    @FXML
    private void clickbtnEqual(ActionEvent event) {

        switch (this.ultimoOperador) {

            case '+':
                this.clickbtnPlus(event);
                break;
            case '-':
                this.clickbtnMinus(event);
                break;
            case '*':
                this.clickbtnBy(event);
                break;
            case '/':
                this.clickbtnDivided(event);
                break;
        }

    }

}
