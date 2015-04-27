import threading
import queue
import interfazwsn
import pcm
import time

if __name__ == "__main__":
    recibidos = queue.Queue()
    a_enviar =  queue.Queue()
    peticiones = queue.Queue()

    hilopcm = pcm.Pcm(recibidos, a_enviar, peticiones)
    hilopcm.start()

    hilowsn = interfazwsn.InterfazWsn(recibidos, a_enviar)
    hilowsn.start()


