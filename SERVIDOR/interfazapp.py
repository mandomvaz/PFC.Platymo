import socket
import threading
import time
import json

class InterfazApp(threading.Thread):
    def __init__(self, envio, pet):
        threading.Thread.__init__(self)
        self.peticiones = pet
        self.a_enviar = envio

    def run(self):
        servidor = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        servidor.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
        servidor.bind(('localhost', 9999))
        servidor.listen(5)
        i = 0
        while True:
            print('----------------------------------------------------------------------------------------------')
            i = i + 1
            conn, (host, puerto) = servidor.accept()
            handler = AppHandler(conn, host, puerto, self.a_enviar, self.peticiones)
            handler.start()
        servidor.close()





class AppHandler(threading.Thread):
    def __init__(self, con, host, puerto, envia, pet):
        threading.Thread.__init__(self)
        self.conexion = con
        self.peticiones = pet
        self.host = host
        self.puerto = puerto
        self.a_enviar = envia

    def run(self):
        data  = self.conexion.recv(1024)
        data = data.decode('UTF-8')
        deco  = json.loads(data)
        respuesta = ""

        if ('peticion' in deco):
            self.peticiones.put(deco)
            respuesta = '{ ok : 1 }'
        else:
            respuesta = '{ fail : 0 }'


        response = json.dumps(respuesta)

        self.conexion.send(bytes(response, 'utf8'))

        self.conexion.close()
