import sys

tokens = sys.stdin.read().split()

if tokens:
    n = int(tokens[0])
    
    cantidad_digitos = len(str(n))

    print(f"The number of digits of {n} is {cantidad_digitos}.")