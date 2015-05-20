import threading
import pymysql
import time
import datetime

class Pcm(threading.Thread):
    def __init__(self, rec, env, pet):
        threading.Thread.__init__(self)
        self.recibidos = rec
        self.enviar = env
        self.peticiones = pet
        self.bd = pymysql.connect(host='127.0.0.1', port=3306, user='root', passwd='05101986', db='platymo')
        self.timers = []

    def run(self):
        flag_temperatura = True
        flag_timers = True
        while True :

            if self.recibidos.qsize() > 0 :
                msj = self.recibidos.get()
                self.recibidos.task_done()

                my = msj[:2]
                func = msj[2:4]
                act = msj[4:6]
                val = msj[6:9]

                if func == "10":
                    self.setValBDActuador(my, act, val)
                elif func == "20":
                    self.setValBDSensor(my, act, val)

            if self.peticiones.qsize() > 0:
                peticion = self.peticiones.get()
                self.peticiones.task_done()

                print(peticion)

                if peticion['peticion'] == "actuador":
                    self.setActuador(peticion['id'], peticion['valor'])

                elif peticion['peticion'] == "escena":
                    self.activarEscena(peticion['escena'])
                elif peticion['peticion'] == "apagarTodo":
                    self.apagarTodo()
                elif peticion['peticion'] == "actualizarTimers":
                    self.setTimers()


            fechahora = time.localtime()
            minmodulo = fechahora[4] % 10

            if (minmodulo == 0 or minmodulo == 5):
                if flag_temperatura:
                    self.peticionTemperatura()
                    flag_temperatura = False
            else:
                flag_temperatura = True

            if (fechahora[3] == 0 and fechahora[4] == 0):
                if flag_timers:
                    self.setTimers()
                    flag_timers = False
            else:
                flag_timers = True





    def setTimers(self):

        for t in self.timers:
            print('cancelando')
            print(t.name)
            t.cancel()
            self.timers.remove(t)

        hora_actual = time.localtime()
        diasem = hora_actual[6]

        actual_delta = datetime.timedelta(seconds = hora_actual[5], minutes = hora_actual[4], hours = hora_actual[3])
        segundos_actual = actual_delta.seconds

        cursor = self.bd.cursor()
        cursor.execute('SELECT a.* FROM acciones AS a, acciones_dias AS ad WHERE a.id = ad.accion_id AND ad.dia_sem = %s', diasem)

        i = 0
        for row in cursor:
            print(row)
            diff = row[3].seconds - segundos_actual
            print('diff')
            print(diff)
            if diff > 0:
                print('juas')
                timer = threading.Timer(diff, self.setActuador, (row[1], row[2]))
                timer.start()
                
                self.timers.append(timer)

    def getIdNodo(self, my):
        cursor = self.bd.cursor()
        cursor.execute('SELECT id FROM nodos WHERE my=%s', (my,) )
        return cursor.fetchone()[0]

    def getMyNodo(self, id):
        cursor = self.bd.cursor()
        cursor.execute('SELECT my FROM nodos WHERE id=%s', (id,) )
        return cursor.fetchone()[0]

    def setActuador(self, id, estado):
        cursor = self.bd.cursor()
        cursor.execute('SELECT * FROM actuadores WHERE id = %s', (id))
        data = dict()
        row = cursor.fetchone()
        data['posicion'] = row[2]
        data['my'] = self.getMyNodo(row[5])
        data['valor'] = estado

        msg = "%(my)s10%(posicion)02d%(valor)03d"
        msg = msg%data

        self.enviar.put(msg)

    def setValBDActuador(self, my, actuador, valor):
        id = self.getIdNodo(my)
        cursor = self.bd.cursor()
        cursor.execute('UPDATE actuadores SET estado=%s WHERE posicion=%s AND nodo_id=%s', (valor, actuador, id))
        self.bd.commit()

    def peticionTemperatura(self):
        cursor = self.bd.cursor()
        cursor.execute('SELECT my FROM nodos')
        for row in cursor:
            self.enviar.put(row[0]+"2000000")

    def setValBDSensor(self, my, sensor, valor):
        id = self.getIdNodo(my)
        cursor = self.bd.cursor()
        cursor.execute('UPDATE sensores SET valor=%s WHERE nodo_id=%s', (valor, id))


    def activarEscena(self, id):

        cursor = self.bd.cursor()
        cursor.execute('SELECT * FROM actuador_escena WHERE escena_id = %s', (id,) )

        for row in cursor:
            self.setActuador(row[1], row[2])

    def apagarTodo(self):
        self.enviar.put("000000000")
