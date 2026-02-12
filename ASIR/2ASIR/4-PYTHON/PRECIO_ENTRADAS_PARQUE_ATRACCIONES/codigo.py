print("BIENVENIDO AL PARQUE DE ATRACCIONES DE NAVARREDONDA")

# INFORMACIONES DE INICIO
import datetime
import random

#EDAD
edad = int(input("¿Cual es tu edad (numero)?: "))
print("Edad: "+ str(edad))

#TIPO DE DIA
dia = input("Escribe el tipo de dia (laboral o finde): ")
print("El tipo de dia es: "+ dia)

#GRUPOS
grupo = input("¿Cual es tu grupo? familiar/colegio/individual: ")
print("Tu grupo es: "+ grupo)

#RESIDENCIA
residencia = input("¿Cual es tu residencia? madrid/otra provincia")
if (residencia == "madrid" or residencia == "Madrid"):
    residencia = "madrid"
elif (residencia == "otra provincia" or residencia == "Otra provincia" or residencia == "otra"):
    residencia = "otra provincia"
else:
    print("Tu residencia no es valida prueba con: ")
print("Residencia: "+ residencia)

#DIA ACTUAL
dias = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"]
hoy_num = datetime.date.today().weekday()
print("Hoy es: "+ dias[hoy_num])

#SOCIO
probabilidades = ['si','si','si','si','si','si','si','si','no','no']
socio = random.choice(probabilidades)
print(socio +" eres socio")

#ALTURA
altura = float(input("¿Cual es tu altura (ejemplo: 1.80)?: "))
print("Tu altura es: "+ str(altura))

# MODIFICACION DE TARIFAS
precioBase = 45.00
# REGLA 1
if (socio == 'si' and edad > 65):
  precioBASE = 0.00
  print("¡Entras Gratis! €"+ str(precioBASE))
  print("""
 .d8888b.
d8P    Y8b
888    888
888    888
888    888
Y8b    d8P
 "Y8888P"
  """)
# REGLA 2
elif (socio == 'si' and residencia == 'madrid'):
  precioBase = 45.00 * 0.5
  print("¡Tienes un descuento del 50%! El precio es de: €"+ str(round(precioBase,2)))
  print("""
  .d8888b.     .d8888b.     88888888
 d88P  Y88    d88P  Y88     888
     .d88P        .d88P     8888888
   .d88P        .d88P            888
  .d88P        .d88P             888
 d88P        d88P          Y8b  d88P
 88888888    88888888   // "Y8888P"

  """)
# REGLA 3
elif (altura < 1.20 or edad < 4):
  precioBase = 45.00 * 0.55
  print("¡Tienes un descuento del 45%! El precio es de: €"+ str(round(precioBase,2)))
  print("""
  .d8888b.     44    44      7PDPD777   55555555
 d88P  Y88b    88    88          88     888
     .d88P     88    88         88      8888888
   .d88P       88888888        88            888
  .d88P              88       88              888
 d88P                88      88        88b   d88P
 88888888            88  // 8P         "Y88888P"


  """)
# REGLA 4
elif (grupo == 'colegio' and (hoy_num == 0 or hoy_num == 4)):
  precioBase = 45.00 * 0.65
  print("¡Tienes un descuento del 35%! El precio es de: €"+ str(round(precioBase,2)))
  print("""
  .d8888b.    .d8888b.     .d8888b.     88888888
 d88P  Y88   d88P  Y88b   d88P  Y88b    888
     .d88P   888    888       .d88P     8888888
   .d88P     "Y8888P88     .d88P            Y88b
  .d88P            888    .d88P              888
 d88P        Y8b  d88P    d88P          Y8b d88P
 88888888     "Y888P"  // 88888888      "Y8888P"
  """)
# REGLA 5
elif (hoy_num == 3 and dia == 'laboral'):
  precioBase = 45.00 * 0.7
  print("¡Tienes un descuento del 30%! El precio es de: €"+ str(round(precioBase,2)))
  print("""
   .d8888b.      .d88         88888888
  d88P  Y88b    .d888         888
       .d88P   d88 88         8888888
      d88P        888             Y88b
       888        888              888
 d88P   88P       888        Y8b  d88P
  "Y8888P"      8888888  //  "Y8888P"

  """)
# REGLA 6
elif (edad < 18 and dia == 'laboral'):
  precioBase = 45.00 * 0.75
  print("¡Tienes un descuento del 25%! El precio es de: €"+ str(round(precioBase,2)))
  print("""
  .d8888b.    .d8888b.       88888888   88888888
 d88P  Y88b  d88P  Y88b          d88P   888
      .d88P       .d88P         d88P    8888888
     d88P        d88P          d88P          Y88b
       888         888         888            888
 d88P  888   d88P  888       d88P      Y8b   d88P
 "Y8888P"    "Y8888P"   //  d88P        "Y8888P"

  """)
# REGLA 7
elif (grupo == 'familiar' and residencia == 'otra provincia'):
  precioBase = 45.00 * 0.8
  print("¡Tienes un descuento del 20%! El precio es de: €"+ str(round(precioBase,2)))
  print("""
  .d8888b.       .8888b.
 d88P  Y88b    d88P
      .d88P   d88P
     d88P    888888bb.
       888   888   Y88b
 d88P  p888  Y88b  d88P
  "Y8888P"    "Y8888P"

  """)
# REGLA 8
elif (18 <= edad <= 25 and socio == 'no'):
  precioBase = 45.00 * 0.90
  print("¡Tienes un descuento del 10%! El precio es de: €"+ str(round(precioBase,2)))
  print("""
     .d8888     .d8888b.        88888888
    d8  888    d88P  Y88b       888
   d8   888    888    888       88888888
  dd8888888    888    888           Y88bb
        888    888    888             888
        888    Y88b  d88P       Y8b  d88P
        888     "Y8888P"   //   "Y8888P"

  """)
# REGLA 9
elif ((hoy_num == 5 or hoy_num == 6) and grupo == 'familiar'):
  precioBase = 45.00 + (45.00 * 0.05)
  print("Recargo del 5%, el precio de la entrada es: €"+ str(round(precioBase,2)))
  print("""
      d888    88888888     .d8888b.    88888888
    d8  88         888    d88P   Y88    888
   d8   88        888          .d88P   8888888
  d8888888       888        .d88P           Y88b
        88      888        .d88P             888
        88     888         d88P        Y8b  d88P
        88    888     //   88888888    "Y8888P"


  """)
# REGLA 10
elif (hoy_num == 2 and residencia == 'otra provincia'):
  precioBase = 45.00 + (45.00 * 0.1)
  print("Recargo del 10%, el precio de la entrada es: €"+ str(round(precioBase,2)))
  print("""
     .d888      .d8888b.        88888888
    d8  88     d88P  Y88b       888
   d8   88     888    888       888888889
  d8888888     "Y8888P888             Y88b
        88            888              888
        88      Y8b  d88P       Y8b   d88P
        88       "Y888P"    //   "Y8888P"

  """)
# REGLA 11
elif (dia == 'finde' and grupo == 'individual' and residencia == 'otra provincia'):
  precioBase = 45.00 + 8.00
  print("Recargo de €8.00, el precio de la entrada es: €"+ str(round(precioBase,2)))
  print("""
  88888888     .d8888b.
  888         d88P  Y88b
  88888888         .d88P
       Y88b      .888P
        888         P88.
  Y8b  d88P   d88P  8888
  "Y8888P"     "Y8888P"

  """)
# REGLA 12
else:
  print("El precio de tu entrada es la tarifa base: €"+ str(round(precioBase,2)))
  print("""
      d888    88888888
    d8  88    888
   d8   88    88888888
  d8888888          888
        88          Y88.
        88    Y8b  d88P
        88    "Y8888P"

  """)