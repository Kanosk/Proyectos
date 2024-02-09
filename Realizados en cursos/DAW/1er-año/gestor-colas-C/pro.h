#include  <stdio.h>
#include <conio.h>
#include <iostream>
#include <string.h>
#include <string>
#include <time.h>
#include <ostream>
using namespace std;
#ifdef _WIN32
    #include <windows.h>
#endif


struct cita{
    string nif;
    string nombre;
    string ape1;
    string ape2;
    string motivo;
    int tiempoCita;
};

struct cola{
    cita colaConsulta[20];
    int posicion=0;
};


cita usuario; //se usa para recoger los datos de las estructuras anteriores
cita usuarioEnConsulta; //usuario que esta en consulta, es el primero de la cola y nunca esta vacio a menos que no haya nadie
cola colaCitas; //cola de citas a gestionar
bool consultaVacia=true;//booleano para verificar si consulta esta vacia (true si hay y false si esta vacia)
cola aux;
cola aux2;

time_t inicioCita;
time_t finCita;
time_t delta;



//menu
//funcionando
//se cargan las citas siempre y cuando haya espacio 
int citaNueva(cola *cola){
    if (cola->posicion < 20){
        cout <<"---------------" <<endl;
        cout <<"Cargando una nueva cita" <<endl;
        cout <<"---------------" <<endl;
            //rellenamos con la estructura cita
            cout << "NIF: "; cin >> usuario.nif;
            cout << "Nombre: "; cin >> usuario.nombre;
            cout << "1er Apellido: "; cin >> usuario.ape1;
            cout << "2o apellido: "; cin >> usuario.ape2;
            cout << "Motivo de la cita: "; cin >> usuario.motivo;
            cout << "Tiempo de consulta: "; cin >> usuario.tiempoCita;
        //verificamos si la consulta esta vacia para pasarlo a consulta o ponerlo en cola
        if (consultaVacia){
            usuarioEnConsulta = usuario;
            consultaVacia = false;
            return (-1);
        }else{
            cola ->colaConsulta[cola->posicion]=usuario;
            cola->posicion++;
            return(cola->posicion);
        }   
    }else{
        return (0);
    }
};

//funcionando
//muestra al usuario en la consulta, recibiendo los datos despues de haberlo cargado y si no hay nadie 
void mostrarUsuarioEnConsulta(cita user){
        if (usuarioEnConsulta.nombre !=""){
            cout <<"---------------"<<endl;
            cout <<"Paciente en consulta"<<endl;
            cout <<"Nombre: "<<"\t";
            cout << usuarioEnConsulta.nombre<<endl;
            cout <<"Nif: "<<"\t\t";
            cout << usuarioEnConsulta.nif<<endl;
            cout <<"Motivo: "<<"\t";
            cout << usuarioEnConsulta.motivo<<endl;
            cout <<"---------------"<<endl;
        }   
} 

//funcionando
void mostrarCola(cola *colaCitas){//recibe la struct cita como parametro y muestra los datos por pantalla
    if (colaCitas->colaConsulta->nombre != ""){
       for (int i = 0; i < colaCitas->posicion; i++)
       {
        cout <<"---------------"<<endl;
        cout <<"Paciente "<< i +1 <<"\t";
        cout << colaCitas->colaConsulta[i].nombre <<"\t";
        cout << colaCitas->colaConsulta[i].nif<<"\t";
        cout << colaCitas->colaConsulta[i].motivo<<endl;
        cout <<"---------------"<<endl;
       }
        cout <<"pacientes en espera ";
        cout << colaCitas->posicion <<endl;
    }
} 

//funcionando
void quitarCita(cola *colaCitas){
    int tamanio = colaCitas->posicion;
    int cit;  
    if(tamanio >1){
        cout<< "----------------" <<endl;
        cout<< "2- Eliminar cita" <<endl;
        cout<< "----------------" <<endl;
        cout << "introduzca la cita que quiera eliminar ";
        cin >> cit;
        cout<< "----------------" <<endl;
        for (int i = cit; i < tamanio; i++){
            cola aux;
            aux.colaConsulta->nombre=colaCitas->colaConsulta[cit ].nombre;
            aux.colaConsulta->nif=colaCitas->colaConsulta[cit ].nif;
            aux.colaConsulta->ape1=colaCitas->colaConsulta[cit ].ape1;
            aux.colaConsulta->ape2=colaCitas->colaConsulta[cit ].ape2;
            aux.colaConsulta->motivo=colaCitas->colaConsulta[cit ].motivo;
            aux.colaConsulta->tiempoCita=colaCitas->colaConsulta[cit ].tiempoCita;
            aux.posicion=colaCitas->posicion -1;

            colaCitas->colaConsulta[cit -1].nombre=aux.colaConsulta->nombre;
            colaCitas->colaConsulta[cit -1].nif=aux.colaConsulta->nif;
            colaCitas->colaConsulta[cit -1].ape1=aux.colaConsulta->ape1;
            colaCitas->colaConsulta[cit -1].ape2=aux.colaConsulta->ape2;
            colaCitas->colaConsulta[cit -1].motivo=aux.colaConsulta->motivo;
            colaCitas->colaConsulta[cit -1].tiempoCita=aux.colaConsulta->tiempoCita;

        }
        colaCitas->posicion = tamanio -1;     
    }else {
        cout << "no hay cita que eliminar"; 
    }
   
};

//funcionando
void intercambiarCita(cola *colaCitas){
    int tamanio = colaCitas->posicion;
    if (tamanio >1){
    int cit1, cit2, ci1, ci2;
    cout << "Seleccione la cita a cambiar"<<endl;
    cin >> cit1; 
    cout << "Seleccione la cita con la que se cambiara" <<endl;
    cin >> cit2;
    ci1=cit1-1;
    ci2=cit2-1;

    cola aux; // guardamos en auxiliar la cita1
    aux.colaConsulta->nombre=colaCitas->colaConsulta[ci1].nombre;
    aux.colaConsulta->nif=colaCitas->colaConsulta[ci1].nif;
    aux.colaConsulta->ape1=colaCitas->colaConsulta[ci1].ape1;
    aux.colaConsulta->ape2=colaCitas->colaConsulta[ci1].ape2;
    aux.colaConsulta->motivo=colaCitas->colaConsulta[ci1].motivo;
    aux.colaConsulta->tiempoCita=colaCitas->colaConsulta[ci1].tiempoCita;

    // pasamos los datos de la cita2 a cita1
    colaCitas->colaConsulta[ci2].nombre=colaCitas->colaConsulta[ci1].nombre;
    colaCitas->colaConsulta[ci2].nif=colaCitas->colaConsulta[ci1].nif;
    colaCitas->colaConsulta[ci2].ape1=colaCitas->colaConsulta[ci1].ape1;
    colaCitas->colaConsulta[ci2].ape2=colaCitas->colaConsulta[ci1].ape2;
    colaCitas->colaConsulta[ci2].motivo=colaCitas->colaConsulta[ci1].motivo;
    colaCitas->colaConsulta[ci2].tiempoCita=colaCitas->colaConsulta[ci1].tiempoCita;

    // ponemos los datos de auxiliar dentro de la cita2
    colaCitas->colaConsulta[ci2].nombre=aux.colaConsulta->nombre;
    colaCitas->colaConsulta[ci2].nif=aux.colaConsulta->nif;
    colaCitas->colaConsulta[ci2].ape1=aux.colaConsulta->ape1;
    colaCitas->colaConsulta[ci2].ape2 =aux.colaConsulta->ape2;
    colaCitas->colaConsulta[ci2].motivo =aux.colaConsulta->motivo;
    colaCitas->colaConsulta[ci2].tiempoCita = aux.colaConsulta->tiempoCita;
    } else{
        cout << "No hay citas que intercambiar"<<endl;
    }
    
    cout << "se han intercambiado las citas seleccionadas "<<endl ;
};

//funcionando 
int urgencia(cola *colaCitas){

    cita aux1, aux2;

    if(colaCitas->posicion<20){

            cout << "-----------------------" <<"\n\n";
            cout << "Introduzca los datos del paciente de urgencia:\n" <<"\n";
            cout << "-----------------------" <<"\n\n";

                cout << "DNI: "; cin >> usuario.nif;
                cout << "Nombre: "; cin >> usuario.nombre;
                cout << "Apellido 1: "; cin >> usuario.ape1;
                cout << "Apellido 2: "; cin >> usuario.ape2;
                cout << "Motivo de la cita: "; cin >> usuario.motivo;
                cout << "Tiempo de consulta: "; cin >> usuario.tiempoCita;

            cout << "-----------------------" << "\n\n";

            aux1=usuarioEnConsulta;
            usuarioEnConsulta=usuario;

        for (int i=colaCitas->posicion; i>0; i--){
                aux2=colaCitas->colaConsulta[i];
                colaCitas->colaConsulta[i]=colaCitas->colaConsulta[i-1];
            }
            
            colaCitas->posicion++;
            colaCitas->colaConsulta[0]=aux1;
            
            cout << "La cola se ha modificado correctamente.\n";

        }else{
            cout << "La cola esta llena. No se pueden introducir más citas.\n";
        }
}

//esto no se como meterlo, me pasaron la captura de pantalla pero no fui a clase cuando se enseño esto
void comprobarTiempoCumplido(){
    finCita=time(NULL);
    delta=finCita - inicioCita;
    cout << "Han pasado "<<delta<< " segundos desde el inicio de la cita \n";
    if (usuarioEnConsulta.tiempoCita <=delta){
        cout << "Tiempo de la cita cumnplido" <<endl;
        usuarioEnConsulta.nombre="";
        usuarioEnConsulta.tiempoCita=0;
        consultaVacia=true;
    }
}