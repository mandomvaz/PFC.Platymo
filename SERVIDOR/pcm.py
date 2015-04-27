import threading
import pymysql
import time

class Pcm(threading.Thread):
    def __init__(self, rec, env, pet):
        threading.Thread.__init__(self)
        self.recibidos = rec
        self.enviar = env
        self.peticiones = pet
        self.bd = pymysql.connect(host='127.0.0.1', port=3306, user='root', passwd='', db='platymo')

    def run(self):

        while True :

            if self.recibidos.qsize() > 0 :
                msj = self.recibidos.get()
                self.recibidos.task_done()

                my = msj[:2]
                func = msj[2:4]
                act = msj[4:6]
                val = msj[6:9]

                if func == "10":
                    self.setBDValAct(my, act, val)
                elif func == "20":
                    self.setValBDSensor(my, act, val)

            if self.peticiones.qsize() > 0:
                peticion = self.peticiones.get()
                self.peticiones.task_done()

                if peticion[0] == "escena":
                    self.activarEscena(peticion[1])
                elif peticion[0] == "apagar":
                    self.apagarTodo()
                elif peticion[0] == "vacaciones":
                    self.activarModoVacaciones()


            fechahora = time.localtime()
            minmodulo = fechahora[4] % 10

            if minmodulo == 0 or minmodulo == 5:
                self.peticionTemp()

            if fechahora[3] == 0 and fechahora[4] == 0:
                self.setTimers(fechahora[6])








    def holamundo(self):
        print("hola mundo")

    def setTimers(self, diasem):
        tuplaSemana = ('lunes','martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo')

        cursor = self.bd.cursor()
        cursor.execute('SELECT ')
        #HAY QUE TERMINAR ESTO





    def peticionTemp(self):
        cursor = self.bd.cursor()
        cursor.execute('SELECT my FROM nodos')
        for row in cursor:
            self.enviar.put(row[0]+"2000000")


    def setValBDAct(self, my, actuador, valor):
        id = self.getIdNodo(my)
        cursor = self.bd.cursor()
        cursor.execute('UPDATE actuadores SET estado=%s WHERE posicion=%s AND id_nodo=%s', (valor, actuador, id))
        self.bd.commit()

    def setValBDSensor(self, my, sensor, valor):
        id = self.getIdNodo(my)
        cursor = self.bd.cursor()
        cursor.execute('UPDATE sensores SET valor=%s WHERE id_nodo=%s', (valor, id))


    def getIdNodo(self, my):
        cursor = self.bd.cursor()
        cursor.execute('SELECT id_nodo FROM nodos WHERE my=%s', (my,) )
        return cursor.fetchone()[0]


