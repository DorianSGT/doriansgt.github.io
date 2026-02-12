import turtle
import sys

# Leemos todo el input de golpe. Recuerda: Ctrl+D para terminar si es manual.
tokens = sys.stdin.read().split()

if not tokens:
    sys.exit("Error: No se introdujeron datos.")

forma = tokens[0]

if forma == 'cercle':
    radio = int(tokens[1])
    turtle.circle(radio)

elif forma == 'quadrat':
    lado = int(tokens[1])
    for _ in range(4):
        turtle.forward(lado)
        turtle.left(90)

elif forma == 'rectangle':
    ancho = int(tokens[1])
    alto = int(tokens[2])
    for _ in range(2):
        turtle.forward(ancho)
        turtle.left(90)  
        turtle.forward(alto)
        turtle.left(90)

turtle.done()