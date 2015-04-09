/* CONFIGURACION */
//MY del nodo
char my[] = "01";
//Numero de interruptores y sus pines correspondientes.
#define NUM_INT 1
int pinIntp[] = {8};
//Numero de actuadores y sus pines correspondientes.
//Para cada interruptor tiene que haber un actuador. Si dos interruptores
//actuan sobre el mismo actuador, duplicar el actuador en el vector.
#define NUM_ACT 1
int pinAct[] = {13};
//Pin del sensor de temperatura. El sensor utilizado aqui es el lm35, este pin debe ser analogico.
int pinTemp = 1;
int vector_temperatura[10];
int bucle_temp = 0;

/* VARIABLES GLOBALES */
//Vector de estado de interruptores
int estadoIntp[NUM_INT];
//Vector de valores de los actuadores
int valorAct[NUM_ACT];
//Variables de control de mensajes
int func, act, val;
int flagmsj = 0;
//Timers
unsigned long int_time[NUM_INT];
//







void setup() {
  Serial.begin(9600);
  int i;
  
  //Interruptores, inicializacion
  for(i = 0; i < NUM_INT; i++){
    pinMode(pinIntp[i], INPUT_PULLUP);
    estadoIntp[i] = digitalRead(pinIntp[i]);
    int_time[i] = 0;
  }
  
  //Actuadores, inicializacion
  for(i = 0; i < NUM_ACT; i++){
    pinMode(pinAct[i], OUTPUT);
    valorAct[i] == 0;
  }
  
  //Sensores
  
}



void loop() {
  int i, est_aux;
 
  
  /* Comunicaciones Recepcion */
  if(Serial.available() > 0){
    recibeMensaje();
    if(flagmsj == 1){
      flagmsj = 0;
      procesaMensaje();
    }
  }
  
  /* Sensores e Interruptores */
  
  //Control de interruptores
  //se comprueban todos los pines de interruptores en busca de cambios en su estado.
  for(i = 0; i < NUM_INT; i++){
    est_aux = digitalRead(pinIntp[i]);
    if(est_aux != estadoIntp[i]){
      estadoIntp[i] = est_aux;
  //Cuando encontramos un cambio hay que comprobar que no se trate de un rebote en la señal.
  //Para ello guardamos el tiempo que lleva arduino encendido.
      if(int_time[i] == 0){
        int_time[i] = millis();
        
        if(valorAct[i] == 0){
          valorAct[i] = 1; 
          enviaMsj(10,i,1);
        }else{
          valorAct[i] = 0;
          enviaMsj(10,i,0);
        }
        
      }else{
  //Cuando hayan pasado 2 segundos volvemos al estado inicial.
        if( millis() - int_time[i] > 2000){
          int_time[i] = 0;
        }
      }
    }
  }
  
  //Lectura de sensores
  //Temperatura
  vector_temperatura[bucle_temp] = 100 + bucle_temp; //analogRead(pinTemp);
  bucle_temp = (bucle_temp + 1) % 10;
  
  
  /* Actualizacion de Actuadores */
  for(i = 0; i < NUM_ACT; i++){
    if(valorAct[i] == 0){
      digitalWrite(pinAct[i], LOW);
    }else{
      digitalWrite(pinAct[i], HIGH);
    }
  }
}


void recibeMensaje(){
  char aux[3], auxval[4];
  char msj[9] = "";
  int p1, p2, p3, p4;
  int numbytes = 0;
  numbytes = Serial.readBytes(msj, 9);
  if(numbytes == 9){
    aux[0] = msj[0];
    aux[1] = msj[1];
    aux[2] = '\0';
    if(strcmp(my, aux) == 0){
      sscanf(msj, "%2d%2d%2d%3d",NULL,&func,&act,&val);
      flagmsj = 1;
    } 
  }else{
    enviaMsj(99, 0, 0);
  }
}
void procesaMensaje(){
  switch(func){
        case 0:
          apagarTodo();
          break;
        case 10:
          setActuador();
          break;
        case 20:
          notificarSensor();
          break;
        default:
          enviaMsj(99,0,0);
          break;
      }
}


void apagarTodo(){
 for(int i; i < NUM_ACT; i++){
   valorAct[i] = 0;
 }
 enviaMsj(0,0,0);
}

void setActuador(){
  if(act < NUM_ACT){
    valorAct[act] = val;
    enviaMsj(func, act, val);
  }else{
    enviaMsj(99, act, val);
  }
}

void notificarSensor(){
  int suma = 0;
  float media;
  for(int i = 0; i < 10; i++){
    suma = suma + vector_temperatura[i];
  }
  media = (float)suma / 10;
  media = (5 * media * 100) / 1024;
  
  enviaMsj(20,00,media*10);
}

void enviaMsj(int funcion, int actuador, int valor){
  char ack[10];
  sprintf(ack, "%s%02d%02d%03d", my, funcion, actuador, valor);
  Serial.print(ack);  
}
