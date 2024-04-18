module chris.prog10_tarea {
    requires javafx.controls;
    requires javafx.fxml;
    requires java.base;

    opens chris.prog10_tarea to javafx.fxml;
    exports chris.prog10_tarea;
}
