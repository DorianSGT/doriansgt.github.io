import tkinter as tk
from tkinter import messagebox
import datetime
import random

# VARIABLES GLOBALES 
datos = {
    "edad": 21,
    "altura": 155, 
    "socio": True,
    "provincia": "madrid",
    "grupo": "familiar",
    "tipo_dia": "fin de semana",
    "dia_semana_num": datetime.date.today().weekday()
}

def calcular_precio():
    edad = int(datos["edad"])
    altura_m = float(datos["altura"]) / 100 
    socio = datos["socio"]
    provincia = datos["provincia"]
    grupo = datos["grupo"]
    tipo_dia = datos["tipo_dia"]
    dia_num = datos["dia_semana_num"]

    precio = 45.00

    if socio == True and edad > 65:
        precio = 0.0
    elif socio == True and provincia == "madrid":
        precio = precio * 0.50     
    elif altura_m < 1.20 or edad < 4:
        precio = precio * 0.55    
    elif grupo == "colegio" and (dia_num == 0 or dia_num == 4):
        precio = precio * 0.65       
    elif dia_num == 3 and tipo_dia == "laboral":
        precio = precio * 0.70      
    elif edad < 18 and tipo_dia == "laboral":
        precio = precio * 0.75      
    elif grupo == "familiar" and provincia == "otra provincia":
        precio = precio * 0.80       
    elif (edad >= 18 and edad <= 25) and socio == False:
        precio = precio * 0.90      
    elif (dia_num == 5 or dia_num == 6) and grupo == "familiar":
        precio = precio + (precio * 0.05)     
    elif dia_num == 2 and provincia != "madrid":
        precio = precio + (precio * 0.10)       
    elif tipo_dia == "fin de semana" and grupo == "individual" and provincia == "otra provincia":
        precio = precio + 8.00
        
    return round(precio, 2)

#  VENTANAS SECUNDARIAS

def abrir_ventana_persona():
   
    v_persona = tk.Toplevel(ventana_principal)
    v_persona.title("Persona")
    v_persona.geometry("300x350")

    # Edad
    tk.Label(v_persona, text="Edad:").pack(pady=5)
    entrada_edad = tk.Entry(v_persona)
    entrada_edad.pack()

    # Altura
    tk.Label(v_persona, text="Altura (cm):").pack(pady=5)
    entrada_altura = tk.Entry(v_persona)
    entrada_altura.pack()

    # Socio
    var_socio = tk.BooleanVar()
    if random.random() < 0.8: 
        var_socio.set(True)
    else:
        var_socio.set(False)
    
    check_socio = tk.Checkbutton(v_persona, text="Es socio", variable=var_socio)
    check_socio.pack(pady=10)

    # Provincia
    var_provi = tk.StringVar()
    var_provi.set("madrid")
    tk.Label(v_persona, text="Provincia:").pack()
    tk.Radiobutton(v_persona, text="Madrid", variable=var_provi, value="madrid").pack()
    tk.Radiobutton(v_persona, text="Otra provincia", variable=var_provi, value="otra provincia").pack()

    def guardar_datos_persona():
        texto_edad = entrada_edad.get()
        texto_altura = entrada_altura.get()

        if texto_edad.isdigit() and texto_altura.isdigit():
            datos["edad"] = int(texto_edad)
            datos["altura"] = int(texto_altura)
            datos["socio"] = var_socio.get()
            datos["provincia"] = var_provi.get()
            v_persona.destroy()
        else:
            messagebox.showerror("Error", "Pon solo números enteros en edad y altura")

    tk.Button(v_persona, text="Guardar", command=guardar_datos_persona).pack(pady=20)


def abrir_ventana_grupo():
    v_grupo = tk.Toplevel(ventana_principal)
    v_grupo.title("Grupo")
    v_grupo.geometry("300x250")

    tk.Label(v_grupo, text="Tipo de grupo:").pack(pady=10)

    lista = tk.Listbox(v_grupo, height=3)
    lista.insert(0, "Familiar")
    lista.insert(1, "Colegio")
    lista.insert(2, "Individual")
    lista.pack()

    def guardar_datos_grupo():
        indices = lista.curselection()
        if len(indices) > 0:
            indice_seleccionado = indices[0]
            texto_seleccionado = lista.get(indice_seleccionado)
            datos["grupo"] = texto_seleccionado.lower()
            v_grupo.destroy()
        else:
            messagebox.showwarning("Ojo", "Selecciona un grupo primero")

    tk.Button(v_grupo, text="Usar selección", command=guardar_datos_grupo).pack(pady=10)


def abrir_ventana_dia():
    v_dia = tk.Toplevel(ventana_principal)
    v_dia.title("Tipo de día")
    v_dia.geometry("370x200")

    var_dia = tk.StringVar()
    var_dia.set("laboral")

    
    tk.Radiobutton(v_dia, text="LABORAL", variable=var_dia, value="laboral", font=("Arial", 16, "bold")).pack(pady=10)
    tk.Radiobutton(v_dia, text="FIN DE SEMANA", variable=var_dia, value="fin de semana", font=("Arial", 16, "bold")).pack(pady=10)

    def guardar_datos_dia():
        datos["tipo_dia"] = var_dia.get()
        v_dia.destroy()

    tk.Button(v_dia, text="Guardar", command=guardar_datos_dia).pack(pady=10)


def abrir_ventana_resultado():
    precio_final = calcular_precio()
    
    if datos["socio"] == True:
        texto_socio = "Sí"
    else:
        texto_socio = "No"

    v_res = tk.Toplevel(ventana_principal)
    v_res.title("Resultado")
    v_res.geometry("500x300")

    texto_resumen = f"Edad: {datos['edad']} | Altura: {datos['altura']} cm | Socio: {texto_socio}"
    texto_resumen2 = f"Provincia: {datos['provincia']} | Grupo: {datos['grupo']}"
    
    tk.Label(v_res, text="Resultado", font=("Arial", 12, "bold")).pack(pady=10)
    tk.Label(v_res, text=texto_resumen).pack()
    tk.Label(v_res, text=texto_resumen2).pack()
    
    tk.Label(v_res, text=f"{precio_final}€", fg="blue", font=("Arial", 45, "bold")).pack(pady=30)


def salir_app():
    ventana_principal.destroy()


# VENTANA PRINCIPAL

ventana_principal = tk.Tk()
ventana_principal.title("NAVARREDONDA VISUAL")
ventana_principal.geometry("400x300")

barra_menu = tk.Menu(ventana_principal)
ventana_principal.config(menu=barra_menu)

menu_calcular = tk.Menu(barra_menu, tearoff=0)
barra_menu.add_cascade(label="Calcular", menu=menu_calcular)

menu_calcular.add_command(label="Persona", command=abrir_ventana_persona)
menu_calcular.add_command(label="Grupo", command=abrir_ventana_grupo)
menu_calcular.add_command(label="Tipo de día", command=abrir_ventana_dia)

barra_menu.add_command(label="Ver Resultado", command=abrir_ventana_resultado)
barra_menu.add_command(label="Salir", command=salir_app)

tk.Label(ventana_principal, text="Usa el menú de arriba para introducir datos", pady=50).pack()

ventana_principal.mainloop()