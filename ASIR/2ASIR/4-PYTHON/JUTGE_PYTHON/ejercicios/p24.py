import turtle
import sys

tokens = sys.stdin.read().split()

if not tokens:
    sys.exit(0)

n = int(tokens[0])
m = int(tokens[1])

for i in range(1, n + 1):
    current_length = i * m 
    turtle.forward(current_length)
    turtle.left(90)

    turtle.forward(current_length)
    turtle.left(90)

turtle.done()