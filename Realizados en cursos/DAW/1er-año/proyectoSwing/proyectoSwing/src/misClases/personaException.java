package misClases;

public class personaException extends Exception {
    private String errorMessage;
    //se crea el constructor sin parametros con el mensaje indefinido
    public personaException(){
        this.errorMessage="Error indefinido";
    }
    //constructor con parametro de string que establece el mensaje
    public personaException(String message){
        this.errorMessage=message;
    }
    //se usa para recibir los mensajes de error desde persona y devuelva el error
    public String getMessage(){
        return this.errorMessage;
    }


}
