
///////////////////
//               //
// CONFIGURACION //
//               //
///////////////////

/////////////////
// MY del nodo //
/////////////////

const char MY[] = "01";


//////////////////////////////////////////////////////////
//Numero de interruptores y sus pines correspondientes. //
//////////////////////////////////////////////////////////


#define NUM_INT 1
int PIN_INTERRUPTORES[] = {7};

//////////////////////////////////////////////////////////////////////////////////////
// Por cada interruptor hay que indicar la posicion dentro del vector de actuadores //
//  del actuador al que modifica.                                                   //
//////////////////////////////////////////////////////////////////////////////////////

int INTERRUPTOR_ACTUADOR[] = {0};


////////////////////////////////////////////////////////
// Numero de actuadores y sus pines correspondientes. //
////////////////////////////////////////////////////////

#define NUM_ACT 2
int PIN_ACTUADORES[] = {11, 13};

///////////////////////////////////////////////////////////////////////////////////////////////////////
// Pin del sensor de temperatura. El sensor utilizado aqui es el lm35, este pin debe ser analogico.  //
///////////////////////////////////////////////////////////////////////////////////////////////////////

int PIN_TEMPERATURA = 1;
int ARRAY_TEMPERATURA[10];

///////////////////////////////////////////////////////////////////////////////////////////////////
// Pin del sensor PIR.                                                                           //
// La posicion de su actuador dentro del vector de actuadores.                                   //
// Y  el tiempo que debe estar encendido. 30000 (30s) para pasillos y 300000 (5min) para baños   //
///////////////////////////////////////////////////////////////////////////////////////////////////

int PIN_PIR = 10;
int ACTUADOR_PIR = 0;
int TIEMPO_PIR = 3000;


//////////////////////////////////////////////////////////////////////////////////////////////////////////
// Pin de la resistencia LDR. Este al igual que el de la temperatura tambien debe ser un pin analogico. //
//////////////////////////////////////////////////////////////////////////////////////////////////////////

int PIN_LDR = 2;

/////////////////////////
//                     //
// VARIABLES GLOBALES  //
//                     //
/////////////////////////

///////////////////////////////////////
// Vector de estado de interruptores //
///////////////////////////////////////

int ESTADO_INTERRUPTORES[NUM_INT];

/////////////////////////////////////////
// Vector de valores de los actuadores //
/////////////////////////////////////////

int VALOR_ACTUADORES[NUM_ACT];

//////////////////////////////////////
// Variables de control de mensajes //
//////////////////////////////////////

int FUNCION_MSJ, ACTUADOR_MSJ, VALOR_MSJ;

////////////
// Flags  //
////////////

int FLAG_PIR = 0;
int FLAG_MSJ = 0;

////////////
// Timers //
////////////

unsigned long TIMER_INTERRUPTOR[NUM_INT];
unsigned long TIMER_PIR;


void setup() {
  Serial.begin(9600);
  int i;
  
  //Interruptores, inicializacion
  for(i = 0; i < NUM_INT; i++){
    pinMode (PIN_INTERRUPTORES[i], INPUT_PULLUP);
    ESTADO_INTERRUPTORES[i] = digitalRead (PIN_INTERRUPTORES[i]);
    TIMER_INTERRUPTOR[i] = 0;
  }
  
  //Actuadores, inicializacion
  for(i = 0; i < NUM_ACT; i++){
    pinMode(PIN_ACTUADORES[i], OUTPUT);
    VALOR_ACTUADORES[i] == 0;
  }
  
  //Sensores
  pinMode(PIN_PIR, INPUT);
}



void loop() {
  int i, est_aux, cantidad_luz, posicion_actuador;
  static int bucle_sensor = 0;
  static int array_luz[10] = {0, 0, 0, 0, 0, 0, 0, 0, 0, 0};

////////////////////////////
// RECEPCION DE MENSAJES  //
////////////////////////////

if(Serial.available() > 0){
  recibeMensaje();
  if(FLAG_MSJ == 1){
    FLAG_MSJ = 0;
    procesaMensaje();
  }
}

///////////////////////////////
// SENSORES E INTERRUPTORES  //
///////////////////////////////

//Control de interruptores


//se comprueban todos los pines de interruptores en busca de cambios en su estado.
for(i = 0; i < NUM_INT; i++){
  est_aux = digitalRead(PIN_INTERRUPTORES[i]);
  
  if(est_aux != ESTADO_INTERRUPTORES[i]){
    ESTADO_INTERRUPTORES[i] = est_aux;

    if(TIMER_INTERRUPTOR[i] == 0){
    //Cuando encontramos un cambio hay que comprobar que no se trate de un rebote en la señal.
    //Si el temporizador esta desactivado (TIMER = 0) se procede al cambio del actuador y activamos el temporizador.
    //Para ello guardamos el tiempo que lleva arduino encendido.
      Serial.println(est_aux);
      TIMER_INTERRUPTOR[i] = millis();
      cambiaActuador(INTERRUPTOR_ACTUADOR[i]);
    }
  }

    
  //Cuando haya pasado 1 segundo desde la activacion del temporizador, lo desactivamos.
  if(TIMER_INTERRUPTOR[i] != 0 && (millis() - TIMER_INTERRUPTOR[i] > 1000)){
    TIMER_INTERRUPTOR[i] = 0;
  }
}

//Lectura de sensores


//Temperatura
ARRAY_TEMPERATURA[bucle_sensor] = 100 + bucle_sensor; //analogRead(PIN_TEMPERATURA);
//Luz
array_luz[bucle_sensor] = 100; //analogRead(PIN_LDR);


bucle_sensor = (bucle_sensor + 1) % 10;
  

//Control de activacion por movimiento


//flag_pir se usa para evitar encendidos y apagados accidentales, es decir, el interruptor tiene preferencia.

if(FLAG_PIR == 0 && digitalRead(PIN_PIR) == HIGH){

  //Si se activa el sensor de movimiento y TIMER_PIR es 0, calculamos la cantidad de luz para saber si es necesario encender la luminaria.
  //Si TIMER_PIR ya contiene un valor, no hay comprobar la luz, puesto que la luminaria esta encendida, nunca se apagaria.
  if(TIMER_PIR == 0){
    for(i = 0; i < 10; i++){
     cantidad_luz += array_luz[i];
   }
   cantidad_luz = cantidad_luz / 10;
   }else{
    cantidad_luz = 0;
  }
  //Siempre que haya movimiento, se reinicia el temporizador.
  if(cantidad_luz < 500){
    TIMER_PIR = millis();
    VALOR_ACTUADORES[ACTUADOR_PIR] = 1;
  }
}

//Para apagar el actuador del pir esperamos el tiempo definido en la configuracion.
if( TIMER_PIR != 0 && (millis() - TIMER_PIR > TIEMPO_PIR)){
  TIMER_PIR = 0;
  VALOR_ACTUADORES[ACTUADOR_PIR] = 0;
}


//////////////////////////////////////
// ACTUALIZACION DE LOS ACTUADORES  //
//////////////////////////////////////

for(i = 0; i < NUM_ACT; i++){
  if(VALOR_ACTUADORES[i] == 0){
    digitalWrite(PIN_ACTUADORES[i], LOW);
    }else{
      digitalWrite(PIN_ACTUADORES[i], HIGH);
    }
  }
}


void recibeMensaje(){
  char aux[3];
  char msj[9] = "";
  int numbytes = 0;
  numbytes = Serial.readBytes(msj, 9);
  if(numbytes == 9){
    aux[0] = msj[0];
    aux[1] = msj[1];
    aux[2] = '\0';
    //solo si el mensaje va dirigido a este nodo, o a la direccion de broadcast.
    if(strcmp(MY, aux) == 0 || strcmp("00", aux) == 0){
      sscanf(msj, "%2d%2d%2d%3d",NULL,&FUNCION_MSJ,&ACTUADOR_MSJ,&VALOR_MSJ);
      FLAG_MSJ = 1;
    }
    }else{
      enviaMsj(99, 0, 0);
    }
  }

  void procesaMensaje(){
    switch(FUNCION_MSJ){
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
     VALOR_ACTUADORES[i] = 0;
   }
   enviaMsj(0,0,0);
 }

 void setActuador(){
  if(ACTUADOR_MSJ < NUM_ACT){
    VALOR_ACTUADORES[ACTUADOR_MSJ] = VALOR_MSJ;
    enviaMsj(FUNCION_MSJ, ACTUADOR_MSJ, VALOR_MSJ);
    }else{
      enviaMsj(99, ACTUADOR_MSJ, VALOR_MSJ);
    }
  }

  void notificarSensor(){
    int suma = 0;
    float media;
    for(int i = 0; i < 10; i++){
      suma = suma + ARRAY_TEMPERATURA[i];
    }
    media = (float)suma / 10;
    media = (5 * media * 100) / 1024;

    enviaMsj(20,00,media*10);
  }

  void enviaMsj(int funcion, int actuador, int valor){
    char ack[10];
    sprintf(ack, "%s%02d%02d%03d", MY, funcion, actuador, valor);
    Serial.print(ack);  
  }

  void cambiaActuador(int pos_actuador){

    int flag_pir_aux, val_timer;

    if( VALOR_ACTUADORES[pos_actuador] == 0){  
      VALOR_ACTUADORES[pos_actuador] = 1;
      flag_pir_aux = 1;
      val_timer = 0;
    }else{
        VALOR_ACTUADORES[pos_actuador] = 0;
        flag_pir_aux = 0;
        val_timer = millis() - TIEMPO_PIR + 1000;
    }

      if(pos_actuador == ACTUADOR_PIR){
        FLAG_PIR = flag_pir_aux;
        TIMER_PIR = val_timer;
      }

      enviaMsj(10, pos_actuador, flag_pir_aux);
    }
