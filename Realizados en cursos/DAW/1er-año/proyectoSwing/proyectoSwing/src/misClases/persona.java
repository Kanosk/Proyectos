package misClases;
import java.io.Serializable;
import java.math.BigInteger;
import java.util.Scanner;
import java.security.MessageDigest;

//la clase persona con los datos que queremos recoger
@SuppressWarnings("unused")
public class persona  implements Serializable{
    private String id; 
    private String añoNac;
    private String Nombre;
    private String Apellidos;
    private String Correo;
    private String Password;
    //constructor vacio para inicializar la clase persona
    public persona(){
    }

    //constructor con los datos usando los getter y setter
    public persona(String Nombre, String Apellidos, String Correo, String añoNac, String id, String Password) throws Exception{
        this.Nombre=Nombre;
        this.Apellidos=Apellidos;
        this.Correo=Correo;
        this.id=id;
        this.añoNac=añoNac;
        this.Password=getSHA512(Password);
    };

    //getters y setter
    public String getID(){ return this.id;}
    public String getNombre(){return this.Nombre;}
    public String getApellidos(){return this.Apellidos ;}
    public String getCorreo(){return this.Correo;}   
    public String getAñonac(){return this.añoNac ;}
    public String getPassword(){return this.Password;}

    public void setID(String id){this.id =id ;}
    public void setNombre(String Nombre){this.Nombre =Nombre ;}
    public void setApellidos(String Apellidos){this.Apellidos =Apellidos ;}
    public void setCorreo(String Correo){this.Correo =Correo ;}
    public void setañoNac(String añoNac){this.añoNac =añoNac ;}
    public void setPassword(String Password){this.Password=getSHA512(Password);}
    
    //pillamos el password y le generamos el SHA512
    public static String getSHA512(String input){
	String toReturn = null;
            try {
                MessageDigest digest = MessageDigest.getInstance("SHA-512");
                digest.reset();
                digest.update(input.getBytes("utf8"));
                toReturn = String.format("%0128x", new BigInteger(1, digest.digest()));
            } catch (Exception e) {
                e.printStackTrace();
            }return toReturn;
        }


    //para recoger los datos de la persona
    public void recogerDatos(){
        Scanner teclado = new Scanner(System.in);
        System.out.print("Id: ");  this.id = teclado.next();
        System.out.print("Nombre: "); this.Nombre = teclado.next();
        System.out.print("Apellidos: ");this.Apellidos = teclado.next();
        System.out.print("Correo: "); this.Correo = teclado.next();
        System.out.print("Año de nacimiento: "); this.añoNac = teclado.next();
        System.out.println("Password: ");this.Password = teclado.next();
        
    }

    //para mostrar los datos que hemos introducido
    public void mostrarDatos(){
        System.out.println("~~~~~~~~~~~~~~~~~~");
        System.out.println("Id: "+this.id);
        System.out.println("Nombre: "+this.Nombre);
        System.out.println("Apellidos: "+this.Apellidos);
        System.out.println("Correo: "+this.Correo);
        System.out.println("Año de nacimiento: "+this.añoNac); 
        System.out.println("Password: "+this.Password);
        System.out.println("~~~~~~~~~~~~~~~~~~");       
    }
    
    
    
    //para cuando tenemos que mostrar datos introducidos por pantalla
    public String getPersona(){
        return "ID: "+this.id+"\nNombre: "+this.Nombre+"\nApellidos: "+this.Apellidos+"\nCorreo: "+this.Correo+"\nAño Nacimiento: "+this.añoNac+"\nPassword"+this.Password+"\n------------";
    }
    
    //para cuando generamos el fichero que despues usaremos para cargar los datos en una nueva ejecución
    public String escribefichero(){
        return this.id+","+this.Nombre+","+this.Apellidos+ ","+this.Correo+","+this.añoNac+","+this.Password;   
    }
    
    
    
}
