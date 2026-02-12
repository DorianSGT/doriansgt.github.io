import turtle
import sys

tokens = sys.stdin.read().split()

if not tokens:
    sys.exit(0)

n = int(tokens[0])
m = int(tokens[1])  

turtle.speed(0) 

for fila in range(n):

    for col in range(n):

        x = col * m
        y = fila * m

        turtle.penup()
        turtle.goto(x, y)
        turtle.pendown()
    
        for _ in range(4):
            turtle.forward(m)
            turtle.left(90)

turtle.done()