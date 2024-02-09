#include "pro.h"


int main()
{
    
    int opcion;
    SetConsoleOutputCP(65001);
    do{
    system("cls");
    mostrarUsuarioEnConsulta(usuarioEnConsulta);
    mostrarCola(&colaCitas);
    

    cout<< "---------------" <<endl;
    cout<< "Por Favor, seleccione una opción" <<endl;
    cout<< "---------------" <<endl;
    cout<< "1- Cargar cita" <<endl;
    cout<< "2- Eliminar cita" <<endl;
    cout<< "3- Intercambiar cita" <<endl;
    cout<< "4- Cita de urgencia" <<endl;
    cout<< "5- salir" <<endl;
    cout<< "---------------" <<endl;
   
    
    

    cin>> opcion ;

    switch (opcion){
        
        case 1:
        system("cls");
        try{
            throw citaNueva(&colaCitas);
        }catch(int e){
            if (e == -1){
                cout <<"Valor devuelto = "<< e << endl;
                cout << "Cita asignada a consulta " << endl;
            }else if(e==0){
                cout << "Valor devuelto = "<< e << endl;
                cout << "No se ha podido crear la cita, esperando que haya espacio libre. " << endl;
            }else {
                cout <<"Valor devuelto = "<< e << endl;
                cout << "Cita creada en la posición "<< e <<" de la cola." << endl;
            }
            getch();
        }; 
            break;
        
        case 2:
        system("cls");
        mostrarCola(&colaCitas);
        quitarCita(&colaCitas);
        cout << "se ha eliminado correctamente la cita"<<endl;   
            
        break; 
        case 3:
        system("cls");
        mostrarCola(&colaCitas);
        cout<< "-------------------"<<endl;
        cout<< "3- Intercambiar cita" <<endl;
        cout<< "-------------------"<<endl;
        intercambiarCita(&colaCitas);
        cout << "se ha modificado correctamente la cita"<<endl;  


        break;
        case 4:
        system("cls");
        mostrarCola(&colaCitas);
        urgencia(&colaCitas);
       system("cls");
       cout<< "se ha creado correctamente la urgencia"<<endl;
       cout << "La cola de pacientes se ha quedado de la siguiente manera: "<<endl;
       cout <<"------------------------------------------------------------------";
        mostrarCola(&colaCitas);
        break;
        
        case 5:
            system("cls");
            cout<< "---------------" <<endl;
            cout << ("Ha elegido cerrar el programa")<< endl;
            cout << ("Que tenga un buen dia") <<endl;
            cout<< "---------------" <<endl;
            exit(1);
            break;

        default: {
            system("cls");
            cout<< "---------------" <<endl;
            cout << ("Debe elegir entre las opciones disponibles")<< endl;
            cout<< "---------------" <<endl;
        }
        }
    } while (opcion !=5);
}
