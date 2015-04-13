import servidor
import recolector
import threading
import serial


if __name__ == "__main__":
    
    bloqueo = threading.Lock()
    ser = serial.Serial('/dev/ttyUSB0')
    
    hilo_servidor = servidor.Servidor(bloqueo, ser)
    hilo_servidor.start()
    hilo_recolector = recolector.Recolector(bloqueo, ser)
    hilo_recolector.start()
    
    hilo_servidor.join()
    hilo_recolector.join()