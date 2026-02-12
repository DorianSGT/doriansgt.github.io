import sys

tokens = sys.stdin.read().split()

if tokens:
    numero_texto = tokens[0]
    print(numero_texto[::-1])