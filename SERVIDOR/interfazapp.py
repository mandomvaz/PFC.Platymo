import socket
import threading
import time
import json

class InterfazApp(threading.Thread):
    def __init__(self, pet):
        threading.Thread.__init__(self)
        self.peticiones = pet

    def run(self):
        servidor = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        servidor.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
        servidor.bind(('localhost', 9999))
        servidor.listen(5)
        i = 0
        while i < 3:
            i = i + 1
            conn, (host, puerto) = servidor.accept()
            handler = AppHandler(conn, host, puerto, self.peticiones)
            handler.start()
        servidor.close()





class AppHandler(threading.Thread):
    def __init__(self, con, host, puerto, pet):
        threading.Thread.__init__(self)
        self.conexion = con
        self.peticiones = pet
        self.host = host
        self.puerto = puerto

    def run(self):
        data  = self.conexion.recv(1024)
        print("conectado")
        print(self.host)
        print(self.puerto)
        print("data:")
        data = data.decode('UTF-8')
        deco  = json.loads(data)
        print(deco)
        response = json.dumps('{ ok : 1, tururu : 2}')
        print(response)
        self.conexion.send(bytes(response, 'utf8'))

        self.conexion.close()
