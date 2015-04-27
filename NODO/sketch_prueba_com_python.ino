int FUNCION_MSJ, ACTUADOR_MSJ, VALOR_MSJ;
const char MY[] = "01";

void setup(){
	Serial.begin(9600);
}

void loop(){
	
	if(Serial.available() > 0){
  		recibeMensaje();
  	}

  	delay(1000);
  	enviaMsj(30,01,000);

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
      enviaMsj(FUNCION_MSJ, ACTUADOR_MSJ, VALOR_MSJ);
    }
    }else{
      enviaMsj(99, 0, 0);
    }
}

void enviaMsj(int funcion, int actuador, int valor){
    char ack[10];
    sprintf(ack, "%s%02d%02d%03d", MY, funcion, actuador, valor);
    Serial.println(ack);
}