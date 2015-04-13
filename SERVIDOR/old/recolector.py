import threading
import time


class Recolector(threading.Thread):
    def __init__(self, bloqueo, ser):
        threading.Thread.__init__(self)
        self.bloqueo = bloqueo
        self.ser = ser
    
    def run(self):
        
        while True:
            self.bloqueo.acquire()
            if (self.ser.inWaiting() >= 7 ):
                print(self.ser.read(7))
            self.bloqueo.release()
           
        
        