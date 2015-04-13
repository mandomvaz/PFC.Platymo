import socket
import time
import threading

class Servidor(threading.Thread):
    def __init__(self, bloqueo, ser):
        threading.Thread.__init__(self)
        self.bloqueo = bloqueo
        self.ser = ser
    
    def run(self):

            sock = socket
            s_listen = sock.socket()
            s_listen.bind(("localhost", 9999))
            s_listen.listen(2)
            i = 0
            while (i < 3):
                s_conexion, (host, puerto) = s_listen.accept()
                hilo_conx = Conexion(host, puerto, s_conexion, self.bloqueo, self.ser)
                hilo_conx.start()
                i = i + 1 
         
            s_listen.close()

class Conexion(threading.Thread):
    def __init__(self, host, puerto, sck, bloqueo, ser):
        threading.Thread.__init__(self)
        self.host = host
        self.puerto = puerto
        self.sck = sck
        self.bloqueo = bloqueo
        self.ser = ser
    
    def run(self):
        print(self.host)
        print(self.puerto)
        
        comando = self.sck.recv(1024)
        print(comando)
        
        self.bloqueo.acquire()
        
#vaciamos el buffer de lectura

        b = self.ser.inWaiting()
        if(b > 0):
            print(self.ser.read(b) + "flush")
#entramos en modo comandos
        self.ser.write("+++")
        nodentro  = True
        while nodentro:
            lectura = self.ser.read(1)
            print(lectura)
            if lectura == '\r':
                nodentro = False 
        print('atdl5')
#modificamos la direccion de destino y salimos
        self.ser.write("ATDL15,CN\r")
        lectura = self.ser.read(6)
        print(lectura)
#enviamos el comando
        
        
        
#cerramos el socket
        self.sck.close()