import threading
import time
import serial
import binascii

class InterfazWsn(threading.Thread):
    def __init__(self, rec, env):
        threading.Thread.__init__(self)
        self.recibidos = rec
        self.enviar = env

    def run(self):
        #wsn = serial.Serial("/dev/ttyACM0", baudrate=9600, timeout=1.0)
        while True:
            if False : #wsn.inWaiting() > 0:
                msj_b = wsn.readline()
                msj = msj_b.decode('ascii')
                print(len(msj))
                print(msj)


            if self.enviar.qsize() > 0 :
                msj = self.enviar.get()
                self.enviar.task_done()
                msj_b = msj.encode()
                print("envio:"+msj)

                self.recibidos.put(msj)
                #wsn.write(msj_b)
