import sys

tokens = sys.stdin.read().split()

if tokens:
    n = int(tokens[0])
    for i in range(n):
        num_espacios = n - 1 - i
        num_estrellas = 2 * i + 1
        print(" " * num_espacios + "*" * num_estrellas)
        
    for i in range(n - 2, -1, -1):
        num_espacios = n - 1 - i
        num_estrellas = 2 * i + 1
        
        print(" " * num_espacios + "*" * num_estrellas)